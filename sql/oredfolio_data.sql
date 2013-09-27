# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: oredfolio
# Generation Time: 2013-09-27 07:16:59 +0000
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

LOCK TABLES `posts_ored` WRITE;
/*!40000 ALTER TABLE `posts_ored` DISABLE KEYS */;

INSERT INTO `posts_ored` (`id`, `pages`, `categories`, `tags`, `filename`, `detail_name`, `title`, `client`, `description`, `size`, `media_type`, `overstatestyle`, `href`, `index`)
VALUES
	(503,'contact','_all','tag1 tag2','ored_contact_map_small','','410 East 13th Street','New York, NY 10003','p:201.602.0069','410x200',0,'half fixed light','http://bit.ly/14BUm7f',458),
	(1,'home','_all','tag1','CFM_summer2013','folio/cfm_montage','ClickFire Media','','In a constantly evolving transmedia landscape, ClickFire Media puts all the tools along with amazing creative talent under one roof to create rich, innovative experiences.','410x410',3,'','',455),
	(500,'contact','_all','tag1 tag2','ored_contact_map','','O Marks the Spot.','Client','','830x410',0,'none','http://bit.ly/14BUm7f',457),
	(502,'contact','_all','tag1 tag2','ored_mail','','Email me anytime','','owen@ored.net','410x200',0,'half fixed light','mailto:owen@ored.net',459),
	(504,'contact','_all','tag1 tag2','ored_twitter','','Follow Me','','@ocorso','410x200',0,'half fixed light','http://twitter.com/ocorso',469),
	(203,'about_me','_all',NULL,'ored_work','about/ored_work','I Work at Click',NULL,'I am a Lead Technologist at a New York City based digital production agency. ','410x200',3,'half fixed light seethrough',NULL,489),
	(13,'home music ','_all jamwithtoast',NULL,'ored_jamwithtoast2','music/jamwithtoast','Battle of the Ad Bands','JWT','During Agency Week 2011, I formed a band with my JWT colleagues and won Battle of the Ad Bands.','200x200',0,NULL,NULL,507),
	(100,'about_me','_all','','owen','about/owen_corso','I Am Owen Corso','Lead Technologist','I have a hunger for knowledge, a thirst for thrilling endeavors, and an undying desire to make the most of the gifts God has given me.','410x200',0,'half fixed light seethrough','',401),
	(3,'home music ','_all thegoodnews',NULL,'ored_jons_song','music/jons_song_video','Jon\'s Song <nobr>Music Video</nobr>','The Good News','A music video I made using my brother\'s footage from his honeymoon','200x200',0,NULL,NULL,506),
	(202,'about_me','_all','tag1 tag2','ored-lax','about/ored_lax','I Play Lacrosse','','For the last 20 years, I\'ve played mens lacrosse at all levels of competition.','410x200',0,'half fixed light seethrough','',453),
	(201,'about_me','_all','tag1 tag2','ored_code','about/ored_code','I Write Code','','I work at the intersection of technology and marketing.','410x200',0,'half fixed light seethrough','',454),
	(200,'about_me home','_all','tag1','ored_rock','about/ored_rock','I Like to Rock',NULL,'I am a born front-man. My abundant energy makes live shows an entertaining experience.','410x200',0,'half fixed light seethrough',NULL,523),
	(401,'home music ','_all redmachine',NULL,'ored_redmachine1','music/i-wont-let-you-down','I Won\'t Let You Down Video','Red Machine','This song is an acoustically driven folk rock melody that I wrote and performed with my band, Red Machine.','200x200',0,NULL,NULL,505),
	(514,'home','_all','tag1 tag2','7_Code','folio/7_Code','Code.org','','Click 3X partnered with director Lesley Chilcott on ?Code Stars,? a short film promoting Code.org','200x200',0,'half','',471),
	(40,'portfolio home','_all development','tag1 tag2','ored_smirnoff','folio/smirnoff','Smirnoff Nightlife Exchange Project','JWT','JWT created a large 3D installation projection piece that was displayed internationally at parties as part of the Smirnoff?s campaign.','200x200',0,'half','',109),
	(38,'portfolio home','_all development design user_experience','tag1 tag2','ICUinParis','folio/icu','ICUINPARIS','ICUinParis','Click 3X redesigned ICU, an interactive online platform where independent designers sell their work and grow their brands.','410x410',0,'half','',108),
	(46,'portfolio home','_all development','how_to','geicopiggyv3','folio/geicopiggyv3','GEICO Piggy Pinwheels App','The Martin Agency','ClickFire Media created a mobile app for GEICO featuring  Maxwell, GEICO?s signature piggy.','200x200',0,'','',75),
	(30,'portfolio home','_all development','dev','ored_skittles','folio/skittles','Skittles.com','Wrigley\'s','Big Spaceship was challenged to create a new website for the Wrigley?s brand, Skittles.','200x200',0,'','',269),
	(32,'portfolio home','_all development','dev','ored_starburst1','folio/starburst','Starburst.com','Wrigley\'s','Big Spaceship was challenged to create a new website for the Wrigley?s brand, Starburst.','200x200',0,'','',270),
	(34,'portfolio home','_all development user_experience design','dev','ored_nickandcampbell','folio/nickandcampbell','Nick + Campbell','Nick + Campbell','On a freelance basis, I created an e-commerce platform from scratch for a boutique fashion brand using the PHP framework Zend.','200x200',0,'','',272),
	(36,'portfolio home','_all development user_experience design','dev','ored_quickspikes1','folio/quickspikes','Quick Spikes','Quick Spikes','On a freelance basis, I created an e-commerce platform for a golf apparel brand using Wordpress and WP e-Commerce.','200x200',0,'','',273),
	(28,'portfolio home','_all social development','facebook_apps other','SharpAppv4_final','folio/SharpAppv4_final','Sharp AQUOS App','','In a direct-to-client execution for Sharp AQUOS, ClickFire Media created the ultimate tailgate experience just in time for football season.','200x200',0,'','',289),
	(26,'portfolio','_all social','facebook_apps','dennys_app','folio/dennys_facebook_app','Denny\'s Facebook App','Gotham','ClickFire Media was challenged to create a Facebook app for Gotham and their client, Denny?s.','410x200',0,'','',265),
	(24,'portfolio home','_all social development','','samsung_camera','folio/samsung_camera','Samsung Camera','Big Fuel','ClickFire Media was challenged by Big Fuel to create a Facebook application for their client, Samsung.','200x200',0,'','',255),
	(18,'portfolio home','_all social development',NULL,'stride','folio/stride','Stride','JWT','JWT challenged ClickFire Media to create a customized Facebook tab and application for their client, Stride Gum.','200x200',NULL,NULL,NULL,482),
	(20,'portfolio','_all development','facebook_apps other','CS_BCA_APP_V2_Small','folio/bca','Breast Cancer Awareness','','As part of an annual Breast Cancer Awareness campaign, ClickFire Media was challenged by Estee Lauder to build a microsite.','200x200',1,'','',88),
	(22,'portfolio','_all social development','facebook app','chevysonicv2','folio/chevysonicv2','Chevy Sonic','Big Fuel','ClickFire Media was challenged by Big Fuel to create a unique car customizer Facebook app for their client, Chevrolet in order to promote the Sonic car line.','410x200',0,'','',254),
	(16,'portfolio home','_all user_experience development',NULL,'ored_mcdonalds','folio/mcdonalds','McDonalds All American Games','','ClickFire Media completely redesigned the home of the historic All American Games.','200x200',1,NULL,NULL,524),
	(29,'portfolio home','_all development','taggy','ored_mobile','folio/ored_mobile','ClickFire Mobile','','More and more, people are moving across screens to consume their content. ClickFire Mobile is one step ahead, preserving a superior user experience on any device with an internet connection.','410x200',0,'','',82),
	(12,'portfolio','_all social development','retail social facebook_apps instagram facebook social','NineWest','folio/nine_west','Nine West','','ClickFire Media was challenged to create a Facebook app for DBA and their client, Nine West.','410x200',0,'','',83),
	(17,'portfolio home','_all social development','facebook social instagram','limitedv2','folio/the_limited','The Limited','','ClickFireMedia was challenged to create a Facebook app for DBA and their client, The Limited','200x200',0,'','',87),
	(14,'portfolio home','_all user_experience design development',NULL,'ored_codefornyc','folio/codefornyc','Code for NYC','','To help give the civic tech community a jumping off point for getting involved with Code for America\'s mission in NYC, I created this website.','410x200',1,NULL,NULL,522),
	(11,'portfolio home','_all user_experience social','roxy','roxy_cs','folio/roxy','Roxy','','ClickFire Media was asked by our client, Digital Brand Architects to create a Facebook based user generated content based contest for ROXY, a leading women\'s action sport apparel company','410x200',0,'','',81),
	(2,'portfolio home','_all development','dev','ored_parksunleashed','folio/parksunleashed','ZYRTEC Parks Unleashed','JWT','I led a team of flash developers in the creation of a series of mini games.','200x200',0,'','',275);

/*!40000 ALTER TABLE `posts_ored` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
