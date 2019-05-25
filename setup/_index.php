<?php


$db->create('databases', [
	'id'		=> ['int',			'null'=>false,	'key'=>'auto'],
	'iv'		=> ['varchar(100)',	'null'=>false,	'collate'=>'ascii_bin'],
	'raw'		=> ['varchar(500)',	'null'=>false,	'collate'=>'ascii_bin'],
	'type'		=> ['varchar(20)',	'null'=>false,	'collate'=>'utf8mb4_unicode_ci'],
	'nickname'	=> ['varchar(500)', 'null'=>false,	'collate'=>'utf8mb4_unicode_ci'],
	'server'	=> ['varchar(500)',	'null'=>false,	'collate'=>'utf8mb4_unicode_ci'],
	'username'	=> ['varchar(500)',	'null'=>true,	'collate'=>'utf8mb4_bin',	'default'=>NULL],
	'password'	=> ['varchar(500)',	'null'=>true,	'collate'=>'utf8mb4_bin',	'default'=>NULL],
	'database'	=> ['varchar(500)',	'null'=>true,	'collate'=>'utf8mb4_bin',	'default'=>NULL],
]);



exit;

/*
 CREATE TABLE `cpnet_user` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_permission` enum('banned','guest','pending','user','admin','team','deactivated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `user_home` enum('homepage','discover') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'discover',
  `user_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_url` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_session` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_icon` binary(16) DEFAULT NULL,
  `user_adfree` bigint(20) NOT NULL DEFAULT 0,
  `user_type` set('cosplay-male','cosplay-female','cosplay-other','photo-event','photo-shoot','video-coverage','video-interview','video-music','commission-general','commission-wig','commission-seamstress','commission-props','commission-casting','commission-armor','commission-accessories','mua','vendor','lolita','steampunk','team','team-leader','team-member','con-staff','artist-alley','panelist') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_url` (`user_url`),
  KEY `user_type` (`user_permission`),
  KEY `user_icon` (`user_icon`),
  KEY `user_type_2` (`user_type`),
  KEY `user_session` (`user_session`),
  CONSTRAINT `cpnet_user_ibfk_1` FOREIGN KEY (`user_icon`) REFERENCES `cpnet_file` (`file_hash`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
*/

//$db->string();

$db->create('user', [
	'user_id'		=> ['bigint(20) unsigned', 'null'=>false, 'key'=>'auto'],
	'user_name'		=> ['varchar(32)', 'collate'=>'utf8mb4_unicode_ci', 'default'=>NULL],
	'user_icon'		=> ['binary(16)', 'default'=>NULL],
]);

/*
CREATE TABLE `cpnet_session` (
  `id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Stores the Session ID',
  `user` bigint(20) unsigned NOT NULL DEFAULT 0,
  `access` bigint(20) unsigned NOT NULL,
  `address` varchar(127) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varbinary(4096) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `access` (`access`),
  CONSTRAINT `cpnet_session_ibfk_1` FOREIGN KEY (`user`) REFERENCES `cpnet_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
*/

$db->create('session', [
	'id'		=> ['varchar(64)', 'collate'=>'ascii_bin', 'null'=>false, 'key'=>'auto'],
	'user'		=> ['bigint(20) unsigned', 'null'=>false, 'default'=>0],
	'access'	=> ['bigint(20) unsigned', 'null'=>false],
	'address'	=> ['varchar(127)', 'collage'=>'ascii_bin', 'default'=>null],
	'data'		=> ['varbinary(4096)', 'null'=>false, 'default'=>''],
]);



/*
 CREATE TABLE `cpnet_altaform` (
  `af_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `af_value` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`af_key`),
  KEY `af_value` (`af_value`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
*/



$db->create('altaform', [
	'af_key'	=> ['varchar(255)', 'collate'=>'utf8mb4_bin', 'null'=>false, 'key'=>'primary'],
	'af_value'	=> ['varchar(10000)', 'collate'=>'utf8mb4_unicode_ci', 'default'=>null],
]);

/*
$db->create('database', [
	'db_name'
]);
*/


echo $db->query();


