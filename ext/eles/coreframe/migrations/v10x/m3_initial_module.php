<?php
namespace eles\coreframe\migrations\v10x; class m3_initial_module extends \phpbb\db\migration\migration { public static function depends_on() { return array('\\eles\\coreframe\\migrations\\v10x\\m2_initial_data'); } public function update_data() { return array(array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'C_ACP')), array('module.add', array('acp', 'C_ACP', array('module_basename' => '\\eles\\coreframe\\acp\\coreframe_module', 'modes' => array('general', 'ads', 'menus', 'style', 'template', 'widgets'))))); } }