<?php
/**
*
* @package Topic description
* @copyright (c) 2020 Tussank Gupta (tg528)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'POSTMANY_DESC'				=> 'Post Many',
	'POSTMANY_DESCRIPTION_3110'	=> 'This extension requires at least phpBB version 3.1.10.  Please update your version of the forum software.',
	'ADD_MULTIPOST'				=> 'Post to multiple groups',
    'ADD_MULTIPOST_EXPLAIN'		=> 'If you want to post this notice to multiple groups, Select all applicable groups below:',
));
