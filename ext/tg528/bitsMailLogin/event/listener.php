<?php
/**
*
* @package BITS Mail Login
* @copyright (c) 2020 Tussank Gupta (tg528)
*
*
*/

namespace tg528\bitsMailLogin\event;

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

	//to connect with the database containing STUDENT/FACULTY etc. tables
	protected $extDbConnection;

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
			'core.oauth_login_after_check_if_provider_id_has_match'		=> 'auto_link_accounts',
		);
	}

	public function dumpy($anything)
	{	
	    global $phpbb_root_path;
	    $log_file = $phpbb_root_path . 'store/my_ext.log';
	    $entry = date('Y-m-d H:i:s ') . print_r($anything, true) . PHP_EOL;
	    file_put_contents($log_file, $entry, FILE_APPEND | LOCK_EX);
	}


	public function connect_external_db(){
		$tgdbhost = 'localhost';
		$tgdbuser = 'root';
		$tgdbpass = '';
		$tgdbname = 'erpdb';
		$this->$extDbConnection = new \phpbb\db\driver\mysqli();
		$this->$extDbConnection->sql_return_on_error(true);
		$this->$extDbConnection->sql_connect($tgdbhost,$tgdbuser,$tgdbpass,$tgdbname,$port = false, $persistency = false, $new_link = false);
		if ($this->$extDbConnection->get_sql_error_triggered()){
			$this->$extDbConnection->sql_return_on_error(false);
			$this->dumpy('survived an error');
			return false;
		}
		else{
			$this->$extDbConnection->sql_return_on_error(false);
			return true;
		}
		
	}


	public function br2gpId($brstr,$gpList){
		$gpName = "Students_".$brstr;
		return $gpList[$gpName];
	}

	public function dept2gpId($deptstr, $gpList){
		$gpName = "Faculty_".$deptstr;
		// $this->dumpy($gpName);
		// $this->dumpy($gpList);
		if(array_key_exists($gpName, $gpList))
			return $gpList[$gpName];
		else
			return -1;
	}

	public function decode_campus_id($campusId, $gpList){
		$start_year = substr($campusId,0,4);
		$brinfo = substr($campusId,4,4);
		$res = [];
		if($brinfo[0] == 'H'){
			//Higher Degree Student
			//TODO: Add Higher degree ID wise rules
			//All programme codes available in bulletin (search for 'Programme Codes')
		}
		elseif($brinfo[0] == 'P'){
			//PhD Student
			array_push($res,$gpList['Students_PhD']);
		}
		else{
			$br1 = substr($brinfo, 0,2);
			$br2 = substr($brinfo, 2);
			array_push($res,$this->br2gpId($br1,$gpList));
			if(!($br2 == "PS" or $br2 == "TS")){
				//Dual Degree Student
				array_push($res,$this->br2gpId($br2,$gpList));
			}
		}
		return $res;
	}


	/**
	* Check if account already exists, if not, create one else check if groups are properly subscribed
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function auto_link_accounts($event){
		global $phpbb_root_path;
		global $phpEx;
		if (!function_exists('user_add') or !function_exists('group_user_add') or !function_exists('group_memberships')or !function_exists('group_user_del')){
			include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
		}
		$group_list = $this->get_group_ids();
		// $this->dumpy($group_list);
		if($event['data']['provider'] == 'google'){
			$google_data = $event['res_auth'];
			$this->dumpy($event['res_auth']);
			$row = $event['row'];
			$email_id = $google_data['email'];
			if(!$row){

				$user_id = $this->get_user_id($email_id);
				if($user_id != -1){
					//a user with this email already exists but needs linking
					$event['new_account_created'] = true;
					$event['new_user_id'] = (int) $user_id;
					$row = [];
					$row['user_id'] = $user_id;
					$event['row'] = $row;
				}
				//No linked user, so we need to create an account
				else if(array_key_exists('hd', $google_data)){
					if($google_data['hd'] == 'pilani.bits-pilani.ac.in'){
						$row = [];
						
						//first connect to the external database containing tables from erp
						if($this->connect_external_db()){
							//Check the STUDENT_TABLE
							$stud_sql = "SELECT CAMPUS_ID FROM STUDENT_TABLE WHERE EMAIL = '".strtolower($email_id)."'";
							$res = $this->$extDbConnection->sql_query($stud_sql);
							$trow = $this->$extDbConnection->sql_fetchrow($res);
							if($trow){
								//Entry found in STUDENT_TABLE
								$add_group_list = $this->decode_campus_id($trow['CAMPUS_ID'],$group_list);
								// $this->dumpy($add_group_list);

								$user_id = $this->create_new_user($google_data['email'],$group_list['REGISTERED']);
								
								// $this->dumpy($user_id);
								//Account created, now we need to link it with this bits mail account
								$event['new_account_created'] = true;
								$event['new_user_id'] = (int) $user_id;
								//Linking done, now we need to subscribe the user to relevant groups

								foreach($add_group_list as $curr_grp){
									group_user_add($curr_grp, $user_id);	
								}
								
							}
							else{
								//Check the FACULTY_TABLE
								$fac_sql = "SELECT EMPLID FROM FACULTY_TABLE WHERE EMAIL = '".strtolower($email_id)."'";
								$res = $this->$extDbConnection->sql_query($fac_sql);
								$trow = $this->$extDbConnection->sql_fetchrow($res);
								if($trow){
									//Entry found in FACULTY_TABLE
									$fac_gp_id = $group_list['Faculty'];

									$fac_dept_sql = "SELECT DEPT FROM FACULTY_DEPT_TABLE WHERE EMPLID = '".$trow['EMPLID']."'";

									$res_subquery = $this->$extDbConnection->sql_query($fac_dept_sql);
									$trow_subquery = $this->$extDbConnection->sql_fetchrow($res_subquery);
									
									$user_id = $this->create_new_user($google_data['email'],$group_list['REGISTERED']);
						
									// $this->dumpy($user_id);
									//Account created, now we need to link it with this bits mail account
									$event['new_account_created'] = true;
									$event['new_user_id'] = (int) $user_id;
									//Linking done, now we need to subscribe the user to relevant groups
									
									group_user_add($fac_gp_id, $user_id,false,false,true);

									while($trow_subquery){
										$add_group = $this->dept2gpId($trow_subquery['DEPT'],$group_list);
										if($add_group != -1)
											group_user_add($add_group,$user_id);
										$trow_subquery = $this->$extDbConnection->sql_fetchrow($res_subquery);
									}
								}
								else{
									$user_id = $this->create_new_user($google_data['email'],$group_list['REGISTERED']);
						
									// $this->dumpy($user_id);
									//Account created, now we need to link it with this bits mail account
									$event['new_account_created'] = true;
									$event['new_user_id'] = (int) $user_id;
									//Linking done, now we need to subscribe the user to relevant groups

									//TODO_later: Check the OTHERS_TABLE
									//This can be done later if required.		
								}
							}
						}	
						//return the newly created user to the login function
						$row['user_id'] = $user_id;
						$event['row'] = $row;
					}
					else{
						$event['email_not_allowed_error'] = true;
					}	
				}
				else{
					$event['email_not_allowed_error'] = true;
				}
			}
			else{
				$user_id = $row['user_id'];
				$tg_subd_groups = group_memberships(false,$user_id,false);
				$subd_groups = [];
				$registered_user_gpid = $group_list['REGISTERED'];
				foreach($tg_subd_groups as $curr){
					if($curr['group_id'] != $registered_user_gpid)
						array_push($subd_groups,$curr['group_id']);	
				}
				$this->dumpy($subd_groups);
				if($this->connect_external_db()){

					$othr_sql = "SELECT EMAIL FROM OTHERS_TABLE WHERE EMAIL = '".strtolower($email_id)."'";
					$res = $this->$extDbConnection->sql_query($othr_sql);
					$trow = $this->$extDbConnection->sql_fetchrow($res);
					
					if(!$trow){
						//not found in Others table
						//Check the STUDENT_TABLE
						$stud_sql = "SELECT CAMPUS_ID FROM STUDENT_TABLE WHERE EMAIL = '".strtolower($email_id)."'";
						$res = $this->$extDbConnection->sql_query($stud_sql);
						$trow = $this->$extDbConnection->sql_fetchrow($res);
						if($trow){
							//Entry found in STUDENT_TABLE
							$add_group_list = $this->decode_campus_id($trow['CAMPUS_ID'],$group_list);
							$this->dumpy($add_group_list);
							//add new groups
							foreach($add_group_list as $curr_grp){
								if(!in_array($curr_grp,$subd_groups)){
									group_user_add($curr_grp, $user_id);	
								}
							}
							//remove old groups
							foreach($subd_groups as $curr_grp){
								if(!in_array($curr_grp,$add_group_list)){
									group_user_del($curr_grp,$user_id);
								}
							}
						}
						else{
							//Check the FACULTY_TABLE
							$fac_sql = "SELECT EMPLID FROM FACULTY_TABLE WHERE EMAIL = '".strtolower($email_id)."'";
							$res = $this->$extDbConnection->sql_query($fac_sql);
							$trow = $this->$extDbConnection->sql_fetchrow($res);

							if($trow){
								//Entry found in FACULTY_TABLE

								$fac_gp_id = $group_list['Faculty'];

								$fac_dept_sql = "SELECT DEPT FROM FACULTY_DEPT_TABLE WHERE EMPLID = '".strtolower($trow['EMPLID'])."'";
								$res = $this->$extDbConnection->sql_query($fac_dept_sql);
								$trow_subquery = $this->$extDbConnection->sql_fetchrow($res);

								$add_group_list = [];
								while($trow_subquery){
									$add_group = $this->dept2gpId($trow_subquery['DEPT'],$group_list);
									if($add_group != -1)
										array_push($add_group_list, $add_group);
									$trow_subquery = $this->$extDbConnection->sql_fetchrow($res);
								}


								if(!in_array($fac_gp_id, $subd_groups)){
									group_user_add($fac_gp_id, $user_id,false,false,true);
								}
								//add new groups
								foreach($add_group_list as $curr_grp){
									if(!in_array($curr_grp,$subd_groups)){
										group_user_add($curr_grp, $user_id);	
									}
								}
								array_push($add_group_list, $fac_gp_id);
								//remove old groups
								foreach($subd_groups as $curr_grp){
									// if($curr_grp != $fac_gp_id){
									// 	group_user_del($curr_grp,$user_id);
									// }
									if(!in_array($curr_grp,$add_group_list)){
										group_user_del($curr_grp,$user_id);
									}
								}
							}
							else{
								//found no-where but account exists
								foreach($subd_groups as $curr_grp){
									group_user_del($curr_grp,$user_id);
								}		
							}
					}


					
						
					}
				}	
				// $this->dumpy($tg_subd_groups);
				//A linked user exists, so we need to sync groups.
			}
			
		}
	}


	public function get_group_ids(){
		$grouplist = [];
		$sql = 'SELECT group_id, group_name
		        FROM ' . GROUPS_TABLE ;
		global $db;
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)){
			$grouplist[$row['group_name']] = $row['group_id'];
		}
		$db->sql_freeresult($result);
		return $grouplist;
	}

	public function get_user_id($email_id){
		$user_id = -1;
		$sql = "SELECT user_id
		        FROM " . USERS_TABLE . " WHERE user_email='" . strtolower($email_id) ."'";
		global $db;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		if($row){
			$user_id = $row['user_id'];
		}
		return $user_id;        
	}

	public function create_new_user($email_id,$default_grp_id){
		$this->dumpy($email_id);
		$uname = (explode('@',$email_id))[0];
		// $pass = md5(rand(0, 100) . time());
		// $pass = substr($pass, 0, rand(8, 12));
		$pass = $uname . "@bits";
		$user_ip = $user->ip;
		$user_type = USER_NORMAL;
		$user_row = array(
		    'username'              => $uname,
		    'user_password'         => phpbb_hash($pass),
		    'user_email'            => $email_id,
		    'group_id'              => (int) $default_grp_id,
		    'user_type'             => $user_type,
		    'user_ip'               => $user_ip,
		);
		
		$user_id = user_add($user_row);

		return $user_id;
	}

	
}
