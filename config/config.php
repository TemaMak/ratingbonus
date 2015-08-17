<?php


$config = array();

$config['db']['table']['bonus_unlocked'] ='___db.table.prefix___bonus_unlocked';

$config['action_bonus'] = array(
	'profile' => array(
		'EventResizeAvatar' => 0.3,
		'EventResizeFoto' => 0.3,
	)
);

$config['profile_bonus'] = array(
	'profile_name' => 0.3,
	'profile_sex' => 0.3,
	'profile_birthday' => 0.1,
);	
	
$config['additional_action'] = array(
	'add_comment' => 0.1,
	'add_topic' => 0.1,
);

$config['acl']['create']['wall']['limit_rating'] = 10;

return $config;

