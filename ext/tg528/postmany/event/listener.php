<?php
/**
*
* @package Post Many
* @copyright (c) 2020 Tussank Gupta (tg528)
*
*
*/

namespace tg528\postmany\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth					$auth				Auth object
	* @param \phpbb\request\request				$request			Request object
	* @param \phpbb\template\template           $template       	Template object
	* @param \phpbb\user                        $user           	User object
	* @access public
	*/
	public function __construct(
			\phpbb\auth\auth $auth,
			\phpbb\request\request $request,
			\phpbb\template\template $template,
			\phpbb\user $user)
	{
		$this->auth = $auth;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
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
			'core.posting_modify_template_vars'		=> 'change_template_vars',
			'core.posting_modify_submit_post_before'		=> 'do_multiple_postings',
		);
	}

	// public function dumpy($anything)
	// {	
	//     global $phpbb_root_path;
	//     $log_file = $phpbb_root_path . 'store/my_ext.log';
	//     $entry = date('Y-m-d H:i:s ') . print_r($anything, true) . PHP_EOL;
	//     file_put_contents($log_file, $entry, FILE_APPEND | LOCK_EX);
	// }

	/**
	* Change the template vars
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function change_template_vars($event){
		$page_data = $event['page_data'];
		$this->user->add_lang_ext('tg528/postmany', 'common');
		$currforum = $event['forum_id'];
		$forumlist = [];
		$sql = 'SELECT forum_name, forum_id
			FROM ' . FORUMS_TABLE . "
			WHERE forum_type = 1";
		global $db;
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)){
			$tmparr = array("id" => $row['forum_id'], "name" => $row['forum_name']);
			array_push($forumlist,$tmparr);
		}
		$db->sql_freeresult($result);

		$page_data['forumlist'] = $forumlist;
		$page_data['currforum'] = $currforum;
		if($event['mode'] == 'post'){
			$page_data['S_SHOW_MULTIPOST_BOX'] = true;
		}
		$event['page_data']	= $page_data;
	}

	/**
	* Do the multiple postings
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function do_multiple_postings($event){
		$forumlist = [];
		
		$sql = 'SELECT forum_id
			FROM ' . FORUMS_TABLE . "
			WHERE forum_type = 1";
		global $db;
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)){
			array_push($forumlist,$row['forum_id']);
		}
		$db->sql_freeresult($result);

		$chkd = array();
		foreach($forumlist as $forum_i){
			$tmpvar = 'tforum_'.$forum_i;
			if($this->request->is_set_post($tmpvar)){
				array_push($chkd, $forum_i);
			}
		}
		$event['post_forums_list'] = $chkd;
	}
	
}
