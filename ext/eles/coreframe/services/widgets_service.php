<?php
namespace eles\coreframe\services; class widgets_service { protected $auth; protected $db; protected $config; protected $template; protected $user; protected $language; protected $phpbb_root_path; protected $php_ext; public function __construct(\phpbb\auth\auth $sp8b3055, \phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, \phpbb\language\language $language, $spe31c2e, $sp14c960) { $this->auth = $sp8b3055; $this->db = $db; $this->config = $config; $this->template = $template; $this->user = $user; $this->language = $language; $this->phpbb_root_path = $spe31c2e; $this->php_ext = $sp14c960; } public function add_widgets_data() { $spe71ceb = request_var('f', 0); $this->template->destroy_block_vars('jumpbox_forums'); $sp27ad83 = $this->phpbb_root_path . 'viewforum.' . $this->php_ext; make_jumpbox(append_sid($sp27ad83), $spe71ceb); $spba7924 = obtain_users_online(); $spf270cd = obtain_users_online_string($spba7924); $sp77a963 = $spf270cd['l_online_users']; $spd076a9 = $spf270cd['online_userlist']; $spaed8b0 = $spba7924['total_online']; $sp2d2fc4 = $this->language->lang('RECORD_ONLINE_USERS', (int) $this->config['record_online_users'], $this->user->format_date($this->config['record_online_date'], false, true)); $sp9cad82 = $this->language->lang('NEWEST_USER', get_username_string('full', $this->config['newest_user_id'], $this->config['newest_username'], $this->config['newest_user_colour'])); $this->template->assign_vars(array('INFOTABS_TOTAL_POSTS' => $this->language->lang('TOTAL_POSTS_COUNT', (int) $this->config['num_posts']), 'INFOTABS_TOTAL_TOPICS' => $this->language->lang('TOTAL_TOPICS', (int) $this->config['num_topics']), 'INFOTABS_TOTAL_USERS' => $this->language->lang('TOTAL_USERS', (int) $this->config['num_users']), 'INFOTABS_NEWEST_USER' => $sp9cad82, 'INFOTABS_TOTAL_USERS_ONLINE' => $sp77a963, 'INFOTABS_LOGGED_IN_USER_LIST' => $spd076a9, 'INFOTABS_RECORD_USERS' => $sp2d2fc4)); $this->spbff71c(); } private function spbff71c() { $sp5c8975 = $this->config->offsetGet('c_wid_recents_nr'); $sp5c8975 = $sp5c8975 ? $sp5c8975 : '5'; $sp0cce62 = '
              SELECT
                t.topic_id,
                t.topic_title,
                t.topic_last_post_id,
                t.forum_id,
                p.post_id,
                p.poster_id,
                p.post_time,
                u.user_id,
                u.username,
                g.group_colour
              FROM ' . TOPICS_TABLE . ' t, ' . FORUMS_TABLE . ' f, ' . POSTS_TABLE . ' p, ' . USERS_TABLE . ' u, ' . GROUPS_TABLE . ' g ' . '
              WHERE
                t.topic_id = p.topic_id
                AND f.forum_id = t.forum_id
                AND t.forum_id != 4
                AND t.topic_status <> 2
                AND t.topic_visibility > 0
                AND p.post_visibility > 0
                AND p.post_id = t.topic_last_post_id
                AND p.poster_id = u.user_id
                AND u.group_id = g.group_id
              ORDER BY p.post_id DESC
              LIMIT ' . $sp5c8975; $sp2ee6ef = $this->db->sql_query($sp0cce62); $sp6a8b6f = $this->db->sql_fetchrowset($sp2ee6ef); $spa56b94 = 'c_widget_recents'; foreach ($sp6a8b6f as $spb504a3) { $spaaf483 = $this->auth->acl_get('f_read', $spb504a3['forum_id']); if ($spaaf483) { $spf7cb04 = '<span style="color: #' . $spb504a3['group_colour'] . '">' . $spb504a3['username'] . '</span>'; $sp961fc0 = $spb504a3['username']; $sp5febc6 = "./memberlist.php?mode=viewprofile&amp;u={$spb504a3['user_id']}"; $spb3f912 = $this->user->format_date($spb504a3['post_time']); $sp40fd8a = $spb504a3['topic_title']; $spc18c8a = append_sid("./viewtopic.php?f={$spb504a3['forum_id']}&amp;t={$spb504a3['topic_id']}&amp;p={$spb504a3['post_id']}#p{$spb504a3['post_id']}"); $this->template->assign_block_vars($spa56b94, array('AUTHOR' => $spf7cb04, 'AUTHOR_CLEAN' => $sp961fc0, 'AUTHOR_URL' => $sp5febc6, 'TIMESTAMP' => $spb3f912, 'TITLE' => $sp40fd8a, 'URL' => $spc18c8a)); } } $this->db->sql_freeresult($sp2ee6ef); } }