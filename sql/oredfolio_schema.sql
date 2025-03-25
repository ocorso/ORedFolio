CREATE TABLE `posts_ored` (
  `id` int(11) DEFAULT NULL,
  `pages` varchar(100) DEFAULT NULL,
  `categories` varchar(300) DEFAULT NULL,
  `tags` varchar(300) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `detail_name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `client` varchar(100) DEFAULT NULL,
  `description` text,
  `size` varchar(10) DEFAULT NULL,
  `media_type` tinyint(2) DEFAULT NULL,
  `overstatestyle` varchar(100) DEFAULT NULL,
  `href` varchar(200) DEFAULT NULL,
  `index` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`index`),
  FULLTEXT KEY `page_index` (`pages`),
  FULLTEXT KEY `category_index` (`categories`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tokens` (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    access_token VARCHAR(255) DEFAULT NULL, 
    token_type VARCHAR(50) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    expires_in INT DEFAULT NULL,
    expires_at DATETIME NULL,
    refresh_token VARCHAR(255) NULL, 
    user_agent VARCHAR(255) NULL, 
    scope TEXT NULL,
    INDEX idx_refresh_token (refresh_token)
);