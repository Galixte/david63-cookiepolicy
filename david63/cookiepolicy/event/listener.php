<?php
/**
*
* @package Cookie Policy Extension
* @copyright (c) 2014 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace david63\cookiepolicy\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\twig\twig */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\log */
	protected $log;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\request\request */
	protected $request;

	/**
	* Constructor for listener
	*
	* @param \phpbb\config\config		$config		Config object
	* @param \phpbb\template\twig\twig	$template	Template object
	* @param \phpbb\user                $user		User object
	* @param \phpbb\log\log				$log		phpBB log
	* @param \phpbb\controller\helper	$helper		Helper object
	* @param \phpbb\request\request		$request	Request object
	*
	* @return \david63\cookiepolicy\event\listener
	* @access public
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\template\twig\twig $template, \phpbb\user $user, \phpbb\log\log $log, \phpbb\controller\helper $helper, \phpbb\request\request $request)
	{
		$this->config	= $config;
		$this->template	= $template;
		$this->user		= $user;
		$this->log		= $log;
		$this->helper	= $helper;
		$this->request	= $request;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	=> 'load_language_on_setup',
			'core.page_header'	=> 'page_header',
			'core.page_footer'	=> 'page_footer',
		);
	}

	/**
	* Load common cookie policy language files during user setup
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function load_language_on_setup($event)
	{
		$lang_set_ext	= $event['lang_set_ext'];
		$lang_set_ext[]	= array(
			'ext_name' => 'david63/cookiepolicy',
			'lang_set' => 'cookiepolicy',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Create the options to show the cookie acceptance box
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function page_header($event)
	{
		$cookie_enabled = $this->config['cookie_policy_enabled'];

		// If we have already set the cookie on this device then there is no need to process
		$cookie_set = $this->request->is_set($this->config['cookie_name'] . '_ca', \phpbb\request\request_interface::COOKIE) ? true : false;

		if ($this->config['cookie_policy_enabled'] && !$cookie_set && !$this->user->data['is_bot'])
		{
			// Only need to do this if we are trying to detect if cookie required
			if ($this->config['cookie_eu_detect'])
			{
				// Setting this to true here means that if there is a problem with the IP lookup then the cookie will be enabled - just in case we have got it wrong!
				$cookie_enabled = true;

				// Check if cURL is available on the server
				if (in_array('curl', get_loaded_extensions()))
				{
					$curl_handle = curl_init();
					curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
					curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl_handle, CURLOPT_URL, 'http://ip-api.com/json/' . $this->user->ip .'?fields=status,countryCode');

					$ip_query = curl_exec($curl_handle);
					curl_close($curl_handle);

					if (empty($ip_query) && $this->config['cookie_log_errors'])
					{
						$this->log->add('critical', $this->user->data['user_id'], $this->user->ip, 'LOG_SERVER_ERROR');
					}
					else
					{
						$ip_array = json_decode($ip_query, true);
						$eu_array = array('AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'EU', 'FI', 'FR', 'FX', 'GB', 'GR', 'HR', 'HU', 'IE', 'IM', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK', 'UK');

						if ($ip_array['status'] == 'success' && !in_array($ip_array['countryCode'], $eu_array))
						{
							// IP not in an EU country therefore we do not need to invoke the Cookie Policy
							$cookie_enabled = false;
						}
						else if ($ip_array['status'] != 'success' && $this->config['cookie_log_errors'])
						{
							$this->log->add('critical', $this->user->data['user_id'], $this->user->ip, 'LOG_COOKIE_ERROR');
						}
					}
				}
				else if ($this->config['cookie_log_errors'])
				{
					$this->log->add('critical', $this->user->data['user_id'], $this->user->ip, 'LOG_CURL_ERROR');
				}
			}

			$this->template->assign_vars(array(
				'COOKIE_BOX_BG_COLOUR'		=> addslashes($this->config['cookie_box_bg_colour']),
				'COOKIE_BOX_HREF_COLOUR'	=> addslashes($this->config['cookie_box_href_colour']),
				'COOKIE_BOX_TXT_COLOUR'		=> addslashes($this->config['cookie_box_txt_colour']),
				'COOKIE_CLASS'				=> $this->config['cookie_box_position'] ? addslashes('cookie-box rightside') : addslashes('cookie-box leftside'),
				'COOKIE_EXPIRES'			=> addslashes($this->config['cookie_expire']),
				'COOKIE_NAME'				=> addslashes($this->config['cookie_name']),

				'S_COOKIE_CUSTOM_BOX'		=> $this->config['cookie_custom_box'],
			));
		}

		$this->template->assign_vars(array(
			'S_SHOW_COOKIE_ACCEPT'	=> $cookie_set,
			'S_COOKIE_ENABLED'		=> $cookie_enabled,
		));
	}

	public function page_footer($event)
	{
		$this->template->assign_vars(array(
			'S_COOKIE_ON_INDEX'		=> $this->config['cookie_on_index'],
			'S_COOKIE_SHOW_POLICY'	=> $this->config['cookie_show_policy'],

			'U_COOKIE_PAGE'			=> $this->helper->route('david63_cookiepolicy_controller', array('name' => 'cookie')),
		));
	}
}
