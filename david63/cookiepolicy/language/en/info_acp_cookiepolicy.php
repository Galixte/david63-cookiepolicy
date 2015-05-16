<?php
/**
*
* @package Cookie Policy Extension
* @copyright (c) 2014 david63
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

/// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ALL'								=> 'All',

	'CLICK_TO_SELECT'					=> 'Click in the box to select a colour',

	'COOKIE_BOX_BG_COLOUR'				=> 'Custom cookie box background colour',
	'COOKIE_BOX_BG_COLOUR_EXPLAIN'		=> 'Select the background colour for the Cookie acceptance box.',
	'COOKIE_BOX_HREF_COLOUR'			=> 'Custom cookie box link colour',
	'COOKIE_BOX_HREF_COLOUR_EXPLAIN'	=> 'Select the acceptance link colour for the Cookie acceptance box.',
	'COOKIE_BOX_TXT_COLOUR'				=> 'Custom cookie box text colour',
	'COOKIE_BOX_TXT_COLOUR_EXPLAIN'		=> 'Select the text colour for the Cookie acceptance box.',
	'COOKIE_BOX_POSITION'				=> 'Cookie box position',
	'COOKIE_BOX_POSITION_EXPLAIN'		=> 'Position the cookie acceptance box on the left or right.',

	'COOKIE_CUSTOM_BOX'					=> 'Use custom cookie box colours',
	'COOKIE_CUSTOM_BOX_EXPLAIN'			=> 'Use the custom colours for theCookie acceptance box.<br />Setting this to <strong>No</strong> will use the default colours.',
	'COOKIE_CUSTOM_PAGE'				=> 'Use custom cookie page colours',
	'COOKIE_CUSTOM_PAGE_EXPLAIN'		=> 'Use the custom colours for theCookie policy page.<br />Setting this to <strong>No</strong> will use the default colours.',

	'COOKIE_DETECT'						=> 'Detect if cookie is required',
	'COOKIE_DETECT_EXPLAIN'				=> 'This will try to detect if the user is in an EU state and will only require cookie acceptance for these users.<br /><strong>Note:</strong> This may not be accurate and it is not recommended for boards where the majority of users are expected to be from the EU.',

	'COOKIE_EXPIRE'						=> 'Cookie expires',
	'COOKIE_EXPIRE_EXPLAIN'				=> 'Setting this to yes will require the user to re accept the Cookie Policy annually.',

	'COOKIE_LEFT'						=> 'Left',

	'COOKIE_LOG_ERRORS'					=> 'Log errors',
	'COOKIE_LOG_ERRORS_EXPLAIN'			=> 'Log any errors that are detected when looking up the user’s IP address.',

	'COOKIE_PAGE_BG_COLOUR'				=> 'Custom cookie page background colour',
	'COOKIE_PAGE_BG_COLOUR_EXPLAIN'		=> 'Select the background colour for the Cookie policy page.',
	'COOKIE_PAGE_TXT_COLOUR'			=> 'Custom cookie page text colour',
	'COOKIE_PAGE_TXT_COLOUR_EXPLAIN'	=> 'Select the text colour for the Cookie policy page.',

	'COOKIE_POLICY'						=> 'Cookie policy',
	'COOKIE_POLICY_ENABLE'				=> 'Cookie policy enable',
	'COOKIE_POLICY_ENABLE_EXPLAIN'		=> 'Enable/disable all user’s requirement to accept the use of cookies, under EU Cookie directive (2012), on this board.',
	'COOKIE_POLICY_EXPLAIN'				=> 'Set the options to manage the Cookie Policy.',
	'COOKIE_POLICY_LOG'					=> '<strong>Cookie policy settings updated</strong>',
	'COOKIE_POLICY_MANAGE'				=> 'Manage settings',
	'COOKIE_POLICY_ON_INDEX'			=> 'Show on index only',
	'COOKIE_POLICY_ON_INDEX_EXPLAIN'	=> 'Show the cookie policy acceptance box on all pages or only on the index page.',
	'COOKIE_POLICY_OPTIONS'				=> 'Cookie policy options',

	'COOKIE_RIGHT'						=> 'Right',

	'COOKIE_SHOW_POLICY'				=> 'Show cookie policy',
	'COOKIE_SHOW_POLICY_EXPLAIN'		=> 'Setting this to yes will display the nav bar link to the cookie policy when the Cookie Policy is disabled, i.e. you can have a cookie policy without the need to have the acceptance box.',

	'CUSTOM_BOX_COLOURS'				=> 'Custom cookie box colours',
	'CUSTOM_BOX_COLOURS_EXPLAIN'		=> '<strong>Here you can change the colours to suit your style for the Cookie acceptance box.</strong>',
	'CUSTOM_PAGE_COLOURS'				=> 'Custom cookie page colours',
	'CUSTOM_PAGE_COLOURS_EXPLAIN'		=> '<strong>Here you can change the colours to suit your style for the Cookie policy page.</strong>',

	'LOG_COOKIE_ERROR'					=> '<strong>Failed IP lookup</stong>',
	'LOG_CURL_ERROR'					=> '<strong>cURL is not available on this server</stong>',
	'LOG_SERVER_ERROR'					=> '<strong>Could not connect to IP server</strong>',

	'UNBAN_IP'							=> 'Unban IP address',
	'UNBAN_IP_EXPLAIN'					=> 'The system will automatically ban any IP address making over 250 requests per minute. If your IP address has been banned, <a href="http://ip-api.com/docs/unban">click here</a> to access an unban form.',

	'YOUR_IP'							=> 'Your server IP address appears to be',
));
