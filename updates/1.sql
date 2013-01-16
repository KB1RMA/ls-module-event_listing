CREATE TABLE IF NOT EXISTS `eventlisting_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url_title` varchar(255) NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `event_url` varchar(700) NULL,
  `description` text NOT NULL,
  `short_description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;