# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: oredfolio
# Generation Time: 2013-09-04 13:03:29 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table posts_ored
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_ored`;

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

LOCK TABLES `posts_ored` WRITE;
/*!40000 ALTER TABLE `posts_ored` DISABLE KEYS */;

INSERT INTO `posts_ored` (`id`, `pages`, `categories`, `tags`, `filename`, `detail_name`, `title`, `client`, `description`, `size`, `media_type`, `overstatestyle`, `href`, `index`)
VALUES
	(799,'portfolio home','featured _all ','montage','CFM_summer2013','portfolio/cfm_montage','CFM Montage','','View a sampling of ClickFireMedia\'s interactive work in this one minute montage','410x410',3,'','',73),
	(781,'portfolio home','interactive mobile _all ','how_to','geicopiggyv3','portfolio/geicopiggyv3','GEICO Piggy Pinwheels App','The Martin Agency','ClickFire Media created a mobile app for GEICO. The app features Maxwell, GEICO’s signature piggy.','200x200',0,'','',75),
	(850,'portfolio home','user_experience _all social facebook instagram','roxy','roxy_cs','portfolio/cfm_roxy_cs','Roxy','','Clickfire Media was asked by our client, Digital Brand Architects to create a Facebook based user generated content based contest for ROXY, a leading women\'s action sport apparel company','410x200',0,'','',81),
	(870,'portfolio home','interactive _all featured advertising','montage','bannerad_montage','portfolio/digital_advertising','Digital Advertising','','View a sampling of ClickFireMedia\'s banners in this one minute montage','200x200',3,'','',82),
	(880,'portfolio home','interactive _all social instagram facebook instagram beauty_fashion retail','retail social facebook_apps instagram facebook social','NineWest','portfolio/nine_west','Nine West','','Challenge: \nClickFireMedia was challenged to create a Facebook app for DBA and their client, Nine West','410x200',0,'','',83),
	(890,'portfolio home','interactive _all social instagram facebook instagram beauty_fashion retail','retail facebook_apps facebook social instagram','limitedv2','portfolio/the_limited','The Limited','','Challenge: \nClickFireMedia was challenged to create a Facebook app for DBA and their client, The Limited','200x200',0,'','',87),
	(900,'portfolio home','social _all interactive innovations beauty_fashion facebook featured','facebook_apps other','CS_BCA_APP_V2_Small','portfolio/bca','Breast Cancer Awareness','','As part of a Breast Cancer Awareness campaign, ClickFire Media was challenged by Digital Brand Architects (DBA) to build a Facebook application that raised awareness for breast cancer','200x200',1,'','',88),
	(2470,'portfolio home','social _all interactive facebook featured','facebook app','chevysonicv2','portfolio/chevysonicv2','Chevy Sonic','Big Fuel','Challenge:\nClickFire Media was challenged by Big Fuel to create a unique car customizer Facebook app for their client, Chevrolet for their Sonic car line','410x200',0,'','',254),
	(2480,'portfolio home','_all interactive social facebook featured','','samsung_camera','portfolio/samsung_camera','Samsung Camera','Big Fuel','Challenge: \nClickFire Media was challenged by Big Fuel to create a Facebook application for their client, Samsung','200x200',0,'','',255),
	(6969,'about_me','_all','tag1','about_ored','about/about_ored','I am O Red',NULL,'I like red things.','200x200',0,'',NULL,523),
	(6970,'my_music','_all',NULL,'music_song_1','music/song1','Song1',NULL,NULL,'200x200',NULL,'',NULL,524),
	(2570,'portfolio home','social _all  facebook interactive retail instagram','facebook_apps','dennys_app','portfolio/dennys_facebook_app','Denny\'s Facebook App','Gotham','ClickFireMedia was challenged to create a Facebook app, which used the Instagram API, for Gotham and their client, Denny\'s.','410x200',0,'','',265),
	(2741,'portfolio home','social _all social interactive games facebook featured','facebook_apps other','SharpAppv4_final','portfolio/SharpAppv4_final','Sharp AQUOS App','','Challenge:\nAs part of a Breast Cancer Awareness campaign','200x200',0,'','',289),
	(444130,'people','_all interactive','','owen','people/owen_corso','Owen Corso','Lead Technologist','<p>A veteran of the agency world, Owen joins the Click family to help strategically position the technology at the forefront finding innovative solutions to the diverse challenges of our clients','410x200',0,'half fixed light seethrough','',401),
	(5,'portfolio home','_all advertising interactive','advertising','advertising_montage_summer2013','portfolio/advertising_montage_summer2013','Advertsing Montage',NULL,NULL,'410x410',3,NULL,NULL,474),
	(6030,'contact','_all','tag1 tag2','contact_map_3','','Post','Client','','830x410',0,'none','http://goo.gl/maps/5a7bF',457),
	(6040,'contact','_all','tag1 tag2','contact_map_small','','16 West 22nd Street','New York, NY 10010','p:212.627.1900 f:212.627.1900','410x200',0,'half fixed light','http://goo.gl/maps/5a7bF',458),
	(10001,'about_us','_all','tag1 tag2','r2be','about/reasontobe','Raison D\'&#202;tre','','Compelling, shareable content has become the primary catalyst for interactions between brands and consumers. Raison D\'etre creates digital engagements and video content focusing on fashion, luxury, and beauty brands.','410x200',0,'half fixed light seethrough','',452),
	(10000,'about_us','_all','tag1 tag2','click3x','about/click3x','Click 3X','','Click 3X was founded in 1993 with the goal of being the first digital studio led by artists with great gear and great support. This mantra hasn\'t changed! With award-winning design, strong visual effects and a visionary animation team.','410x200',0,'half fixed light seethrough','',453),
	(5010,'','_all','tag1 tag2','cfm','about/clickfire_media','Clickfire Media','','In a constantly evolving transmedia landscape, ClickFire Media puts all the tools along with amazing creative talent under one roof to create rich, innovative interactive experiences.','410x200',0,'half fixed light seethrough','',454),
	(5020,'','_all','tag1 tag2','C3X_ENTERTAINMENT_MONTAGE_FALL2011','about/click3x_broadcastentertainment','Click 3X Broadcast & Entertainment','','You can do anything with a big idea and some enthusiasm, but having high-end design, animation and visual effects doesn\'t hurt. Add them both together and you get Click 3X Entertainment.','410x200',0,'half fixed light seethrough','',455),
	(5030,'','_all','tag1 tag2','click3x','about/live_action','Live Action','','Click 3X Live action films commercials and content.  With a robust veteran roster of live-action directors, which includes Jonathan Yi, Juan Delcan, Simon Blake, and the duo of Josh + Vince and headed by EP/MD Megan Kelly.','410x200',0,'half fixed light seethrough','',456),
	(3321,'portfolio home','_all facebook social video_integration',NULL,'stride','portfolio/stride','Stride','JWT','JWT challenged ClickFire Media to create a customized Facebook tab and application for their client, Stride Gum.','200x200',NULL,NULL,NULL,482),
	(8000,'about_us','_all',NULL,'about_who_we_are','about/about_who_we_are','Who We Are',NULL,'In a constantly evolving landscape, ClickFire Media puts all the tools along with amazing creative and technology talent under one roof. ','410x200',0,'half fixed light seethrough',NULL,489),
	(8010,'about_us','_all',NULL,'about_what_we_do','about/about_what_we_do','What We Do',NULL,'Yeah, we were that kid in your neighborhood that got stuck in the tree because we were seeing how high we could climb.  ','410x200',0,'half fixed light seethrough',NULL,490),
	(9000,'about_us ','_all ',NULL,'about_innovations_technology','about/about_innovations_technology','Innovations & Technology',NULL,'Any movie villain will tell you that they are nothing without their use of technology.','410x200',0,'half fixed light seethrough',NULL,491),
	(9010,'about_us','_all',NULL,'about_web','about/about_web','Web',NULL,'The wild frontier that is the web, still continues to be a band of wild horses, wandering free.  ','410x200',0,'half fixed light seethrough',NULL,492),
	(9020,'about_us','_all',NULL,'about_social','about/about_social','Social',NULL,'Users of social media have been kind enough make most of their personal lives public.  ','410x200',0,'half fixed light seethrough',NULL,493),
	(9030,'about_us','_all',NULL,'about_mobile','about/about_mobile','Mobile',NULL,'We live in the future, folks. And fine, we didn\'t get the jetpacks (yet) or the robot cops (no please), we did get nifty personal communicators.  ','410x200',0,'half fixed light seethrough',NULL,494),
	(9040,'about_us','_all',NULL,'about_experiential','about/about_experiential','Experiential',NULL,'When our parents told us to go outside and play, we did.  And we really never stopped.  ','410x200',0,'half fixed light seethrough',NULL,495),
	(9050,'about_us','_all',NULL,'about_advertising','about/about_advertising','Advertising',NULL,'The banner lives!  Only now the traditional banner (invented by HotWired 17 years ago!) lives in so many seductive forms. ','410x200',0,'half fixed light seethrough',NULL,496),
	(115,'blog','_all blog interactive',NULL,'3_r2b1','blog/3_r2b1','Click 3X Launches Raison D?Être, Summers Appointed as Director of Creative Strategy',NULL,'As high-end consumers converge upon the digital space','200x200',NULL,NULL,NULL,503),
	(3,'blog ','_all blog ',NULL,'peter_blog_vine','blog/peter_blog_vine','Vine v. Instagram Video',NULL,'As we launch our first full Vine campaign for AT&T and BBDO, we really had to confront the incredibly rapid emergence of Instagram video','410x410',NULL,NULL,NULL,505),
	(116,'blog','_all blog interactive',NULL,'sharp_blog','blog/sharp_blog','CFM Creates The Ultimate Tailgate Experience For Sharp',NULL,'To commemorate the start of football season, CFM developed a Facebook app that encouraged Sharp\'s fans to create their ultimate tailgate experience. ','200x200',NULL,NULL,NULL,504),
	(33,'portfolio home','_all',NULL,'about_innovations_technology','portfolio/about_innovations_technology','Innovations & Technology',NULL,'Any movie villain will tell you that they are nothing without their use of technology.','410x200',NULL,NULL,NULL,508),
	(117,'blog ','_all blog featured',NULL,'matt_blog_roxy','blog/matt_blog_roxy','Roxy',NULL,'As the Finalists of Roxy\'s Dare Yourself campaign are announced it\'s a good time to look back on how crowd sourced media as a whole','200x200',NULL,NULL,NULL,515),
	(3005,'portfolio home','_all click3rx',NULL,'tradjenta','portfolio/tradjenta','Tradjenta',NULL,NULL,'200x200',1,NULL,NULL,521);

/*!40000 ALTER TABLE `posts_ored` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
