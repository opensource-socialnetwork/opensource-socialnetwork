--
-- Table structure for table `ossn_annotations`
--

CREATE TABLE IF NOT EXISTS `ossn_annotations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `owner_guid` bigint(20) NOT NULL,
  `subject_guid` bigint(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_components`
--

CREATE TABLE IF NOT EXISTS `ossn_components` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `com_id` varchar(20) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ossn_components`
--

INSERT INTO `ossn_components` (`id`, `com_id`, `active`) VALUES
(1, 'OssnProfile', 1),
(2, 'OssnWall', 1),
(3, 'OssnComments', 1),
(4, 'OssnLikes', 1),
(5, 'OssnPhotos', 1),
(6, 'OssnNotifications', 1),
(7, 'OssnSearch', 1),
(8, 'OssnMessages', 1),
(9, 'OssnAds', 1),
(10, 'OssnGroups', 1),
(11, 'OssnSitePages', 1),
(12, 'OssnBlock', 1),
(13, 'OssnChat', 1),
(14, 'OssnPoke', 1),
(15, 'OssnInvite', 1),
(16, 'OssnEmbed', 1),
(17, 'OssnSmilies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ossn_entities`
--

CREATE TABLE IF NOT EXISTS `ossn_entities` (
  `guid` bigint(20) NOT NULL AUTO_INCREMENT,
  `owner_guid` bigint(20) NOT NULL,
  `type` text NOT NULL,
  `subtype` text NOT NULL,
  `time_created` int(11) NOT NULL,
  `time_updated` int(11) DEFAULT NULL,
  `permission` int(1) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_entities_metadata`
--

CREATE TABLE IF NOT EXISTS `ossn_entities_metadata` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `guid` bigint(20) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_likes`
--

CREATE TABLE IF NOT EXISTS `ossn_likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) NOT NULL,
  `guid` bigint(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_messages`
--

CREATE TABLE IF NOT EXISTS `ossn_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `message_from` bigint(20) NOT NULL,
  `message_to` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `viewed` varchar(1) DEFAULT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_notifications`
--

CREATE TABLE IF NOT EXISTS `ossn_notifications` (
  `guid` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` text CHARACTER SET latin1 NOT NULL,
  `poster_guid` bigint(20) NOT NULL,
  `owner_guid` bigint(20) NOT NULL,
  `subject_guid` bigint(20) NOT NULL,
  `viewed` varchar(1) DEFAULT NULL,
  `time_created` int(11) NOT NULL,
  `item_guid` bigint(20) NOT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_object`
--

CREATE TABLE IF NOT EXISTS `ossn_object` (
  `guid` bigint(20) NOT NULL AUTO_INCREMENT,
  `owner_guid` bigint(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `time_created` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` longtext NOT NULL,
  `subtype` text NOT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_relationships`
--

CREATE TABLE IF NOT EXISTS `ossn_relationships` (
  `relation_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `relation_from` bigint(20) NOT NULL,
  `relation_to` bigint(20) NOT NULL,
  `type` varchar(20)  NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`relation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_site_settings`
--

CREATE TABLE IF NOT EXISTS `ossn_site_settings` (
  `setting_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ossn_site_settings`
--

INSERT INTO `ossn_site_settings` (`setting_id`, `name`, `value`) VALUES
(1, 'theme', 'goblue'),
(2, 'site_name', '<<sitename>>'),
(3, 'language', 'en'),
(4, 'cache', '0'),
(5, 'owner_email', '<<owner_email>>'),
(6, 'notification_email', '<<notification_email>>'),
(7, 'upgrades', '["1410545706.php","1411396351.php", "1412353569.php","1415553653.php","1415819862.php", "1423419053.php", "1423419054.php", "1439295894.php", "1440716428.php", "1440867331.php", "1440603377.php", "1443202118.php", "1443211017.php", "1443545762.php", "1443617470.php", "1446311454.php", "1448807613.php", "1453676400.php", "1459411815.php", "1468010638.php", "1470127853.php", "1480759958.php", "1495366993.php"]'),
(9, 'display_errors', 'off'),
(10, 'site_key', '<<screat>>'),
(11, 'last_cache', ''),
(12, 'site_version', '4.4');


-- --------------------------------------------------------

--
-- Table structure for table `ossn_users`
--

CREATE TABLE IF NOT EXISTS `ossn_users` (
  `guid` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `salt` varchar(8) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `last_login` int(11) NOT NULL,
  `last_activity` int(11) NOT NULL,
  `activation` text,
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ossn v4.2 Database improvements
--

ALTER TABLE `ossn_annotations`
	ADD KEY `owner_guid` (`owner_guid`),
	ADD KEY `subject_guid` (`subject_guid`),
	ADD KEY `time_created` (`time_created`);
  
ALTER TABLE `ossn_annotations` ADD FULLTEXT KEY `type` (`type`);

ALTER TABLE `ossn_entities`
	ADD KEY `owner_guid` (`owner_guid`),
	ADD KEY `time_created` (`time_created`),
	ADD KEY `time_updated` (`time_updated`),
	ADD KEY `active` (`active`),
	ADD KEY `permission` (`permission`);
  
ALTER TABLE `ossn_entities` 
	ADD FULLTEXT KEY `type` (`type`),
	ADD FULLTEXT KEY `subtype` (`subtype`);

ALTER TABLE `ossn_entities_metadata`
	ADD KEY `guid` (`guid`);
  
ALTER TABLE `ossn_entities_metadata` ADD FULLTEXT KEY `value` (`value`);

ALTER TABLE `ossn_notifications`
	ADD KEY `poster_guid` (`poster_guid`),
	ADD KEY `owner_guid` (`owner_guid`),
	ADD KEY `subject_guid` (`subject_guid`), 
	ADD KEY `time_created` (`time_created`),
	ADD KEY `item_guid` (`item_guid`);
ALTER TABLE `ossn_notifications` ADD FULLTEXT KEY `type` (`type`);

ALTER TABLE `ossn_object`
	ADD KEY `owner_guid` (`owner_guid`),
	ADD KEY `time_created` (`time_created`);
  
ALTER TABLE `ossn_object` 
	ADD FULLTEXT KEY `type` (`type`),
	ADD FULLTEXT KEY `subtype` (`subtype`);

ALTER TABLE `ossn_relationships`
	ADD KEY `relation_to` (`relation_to`),
	ADD KEY `relation_from` (`relation_from`),
	ADD KEY `time` (`time`);
ALTER TABLE `ossn_relationships` ADD FULLTEXT KEY `type` (`type`);

ALTER TABLE `ossn_users`
	ADD KEY `last_login` (`last_login`),
	ADD KEY `last_activity` (`last_activity`),
	ADD KEY `time_created` (`time_created`);
  
ALTER TABLE `ossn_users`
	ADD FULLTEXT KEY `type` (`type`),
	ADD FULLTEXT KEY `email` (`email`),
	ADD FULLTEXT KEY `first_name` (`first_name`),
	ADD FULLTEXT KEY `last_name` (`last_name`);
