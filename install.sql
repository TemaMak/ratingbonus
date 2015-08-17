CREATE TABLE IF NOT EXISTS `prefix_bonus_unlocked` (
  `user_id` bigint(20) DEFAULT NULL,
  `bonus_tag` varchar(255) DEFAULT NULL,
  UNIQUE KEY `UK_bonus_unlocked` (`bonus_tag`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;