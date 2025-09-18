--
-- Table structure for table `ossn_annotations`
--

CREATE TABLE `ossn_annotations` (
  `id` bigint NOT NULL,
  `owner_guid` bigint NOT NULL,
  `subject_guid` bigint NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `time_created` int NOT NULL,
  `time_updated` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_components`
--

CREATE TABLE `ossn_components` (
  `id` bigint NOT NULL,
  `com_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(17, 'OssnSmilies', 1),
(18, 'OssnSounds', 1),
(19, 'OssnAutoPagination', 1),
(20, 'OssnMessageTyping', 1),
(21, 'OssnRealTimeComments', 1),
(22, 'OssnPostBackground', 1),
(23, 'OssnGiphy', 1),
(24, 'OssnLocation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ossn_entities`
--

CREATE TABLE `ossn_entities` (
  `guid` bigint NOT NULL,
  `owner_guid` bigint NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `subtype` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `time_created` int NOT NULL,
  `time_updated` int DEFAULT NULL,
  `permission` int NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_entities_metadata`
--

CREATE TABLE `ossn_entities_metadata` (
  `id` bigint NOT NULL,
  `guid` bigint NOT NULL,
  `value` longtext COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_likes`
--

CREATE TABLE `ossn_likes` (
  `id` bigint NOT NULL,
  `subject_id` bigint NOT NULL,
  `guid` bigint NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `subtype` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_messages`
--

CREATE TABLE `ossn_messages` (
  `id` bigint NOT NULL,
  `message_from` bigint NOT NULL,
  `message_to` bigint NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `viewed` varchar(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_notifications`
--

CREATE TABLE `ossn_notifications` (
  `guid` bigint NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `poster_guid` bigint NOT NULL,
  `owner_guid` bigint NOT NULL,
  `subject_guid` bigint NOT NULL,
  `viewed` varchar(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_created` int NOT NULL,
  `item_guid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_object`
--

CREATE TABLE `ossn_object` (
  `guid` bigint NOT NULL,
  `owner_guid` bigint NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `time_created` int NOT NULL,
  `time_updated` int NOT NULL,
  `title` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `subtype` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_relationships`
--

CREATE TABLE `ossn_relationships` (
  `relation_id` bigint NOT NULL,
  `relation_from` bigint NOT NULL,
  `relation_to` bigint NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ossn_site_settings`
--

CREATE TABLE `ossn_site_settings` (
  `setting_id` bigint NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 'upgrades', ''),
(9, 'display_errors', 'off'),
(10, 'site_key', '<<secret>>'),
(11, 'last_cache', ''),
(12, 'site_version', '<<siteversion>>');

-- --------------------------------------------------------

--
-- Table structure for table `ossn_users`
--

CREATE TABLE `ossn_users` (
  `guid` bigint NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(65) COLLATE utf8mb4_general_ci NOT NULL,
  `salt` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `last_login` int NOT NULL,
  `last_activity` int NOT NULL,
  `activation` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_created` int NOT NULL,
  `time_updated` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ossn_annotations`
--
ALTER TABLE `ossn_annotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_guid` (`owner_guid`),
  ADD KEY `subject_guid` (`subject_guid`),
  ADD KEY `time_created` (`time_created`),
  ADD KEY `type` (`type`),
  ADD KEY `idx_annotations_type_subject` (`type`,`subject_guid`),
  ADD KEY `time_updated` (`time_updated`);

--
-- Indexes for table `ossn_components`
--
ALTER TABLE `ossn_components`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `index_com_id` (`com_id`),
  ADD KEY `index_active` (`active`);

--
-- Indexes for table `ossn_entities`
--
ALTER TABLE `ossn_entities`
  ADD PRIMARY KEY (`guid`),
  ADD KEY `owner_guid` (`owner_guid`),
  ADD KEY `time_created` (`time_created`),
  ADD KEY `time_updated` (`time_updated`),
  ADD KEY `active` (`active`),
  ADD KEY `permission` (`permission`),
  ADD KEY `type` (`type`),
  ADD KEY `subtype` (`subtype`),
  ADD KEY `eky_ts` (`type`,`subtype`),
  ADD KEY `idx_entities_type_owner` (`type`,`owner_guid`),
  ADD KEY `idx_owner_type_subtype` (`owner_guid`,`type`,`subtype`);

--
-- Indexes for table `ossn_entities_metadata`
--
ALTER TABLE `ossn_entities_metadata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guid` (`guid`),
  ADD KEY `idx_guid_value` (`guid`,`value`(50));
ALTER TABLE `ossn_entities_metadata` ADD FULLTEXT KEY `value` (`value`);

--
-- Indexes for table `ossn_likes`
--
ALTER TABLE `ossn_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtype` (`subtype`),
  ADD KEY `index_subject_id_guid_type` (`subject_id`,`guid`,`type`),
  ADD KEY `index_subject_id_type` (`subject_id`,`type`);

--
-- Indexes for table `ossn_messages`
--
ALTER TABLE `ossn_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_to` (`message_to`),
  ADD KEY `message_from` (`message_from`),
  ADD KEY `index_from_to` (`message_from`,`message_to`),
  ADD KEY `index_to_from` (`message_to`,`message_from`);

--
-- Indexes for table `ossn_notifications`
--
ALTER TABLE `ossn_notifications`
  ADD PRIMARY KEY (`guid`),
  ADD KEY `poster_guid` (`poster_guid`),
  ADD KEY `owner_guid` (`owner_guid`),
  ADD KEY `subject_guid` (`subject_guid`),
  ADD KEY `time_created` (`time_created`),
  ADD KEY `item_guid` (`item_guid`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `ossn_object`
--
ALTER TABLE `ossn_object`
  ADD PRIMARY KEY (`guid`),
  ADD KEY `owner_guid` (`owner_guid`),
  ADD KEY `time_created` (`time_created`),
  ADD KEY `type` (`type`),
  ADD KEY `subtype` (`subtype`),
  ADD KEY `oky_ts` (`type`,`subtype`),
  ADD KEY `oky_tsg` (`type`,`subtype`,`guid`),
  ADD KEY `time_updated` (`time_updated`);

--
-- Indexes for table `ossn_relationships`
--
ALTER TABLE `ossn_relationships`
  ADD PRIMARY KEY (`relation_id`),
  ADD KEY `relation_to` (`relation_to`),
  ADD KEY `relation_from` (`relation_from`),
  ADD KEY `time` (`time`),
  ADD KEY `type` (`type`),
  ADD KEY `idx_relation_forward` (`relation_from`,`relation_to`,`type`),
  ADD KEY `idx_relation_reverse` (`relation_to`,`relation_from`,`type`),
  ADD KEY `idx_to_type` (`relation_to`,`type`),
  ADD KEY `idx_from_type` (`relation_from`,`type`);

--
-- Indexes for table `ossn_site_settings`
--
ALTER TABLE `ossn_site_settings`
  ADD PRIMARY KEY (`setting_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ossn_users`
--
ALTER TABLE `ossn_users`
  ADD PRIMARY KEY (`guid`),
  ADD UNIQUE KEY `index_username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `last_login` (`last_login`),
  ADD KEY `last_activity` (`last_activity`),
  ADD KEY `time_created` (`time_created`),
  ADD KEY `time_updated` (`time_updated`),
  ADD KEY `type` (`type`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ossn_annotations`
--
ALTER TABLE `ossn_annotations`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ossn_components`
--
ALTER TABLE `ossn_components`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ossn_entities`
--
ALTER TABLE `ossn_entities`
  MODIFY `guid` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ossn_entities_metadata`
--
ALTER TABLE `ossn_entities_metadata`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ossn_likes`
--
ALTER TABLE `ossn_likes`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ossn_messages`
--
ALTER TABLE `ossn_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ossn_notifications`
--
ALTER TABLE `ossn_notifications`
  MODIFY `guid` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ossn_object`
--
ALTER TABLE `ossn_object`
  MODIFY `guid` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ossn_relationships`
--
ALTER TABLE `ossn_relationships`
  MODIFY `relation_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ossn_site_settings`
--
ALTER TABLE `ossn_site_settings`
  MODIFY `setting_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ossn_users`
--
ALTER TABLE `ossn_users`
  MODIFY `guid` bigint NOT NULL AUTO_INCREMENT;
COMMIT;