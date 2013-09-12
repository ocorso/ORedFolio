<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Soundcloud API Config
* 
* Authors:  Ben Edmunds            |    Plasticated
*           ben.edmunds@gmail.com       http://plasticated.com
*           @benedmunds
*           
* Created:  10.20.2009 
* 
* Description:  Config file for Soundcloud API
* 
* Requirements: You need to register your app with SoundCloud for your key 
*               and secret at http://soundcloud.com/settings/applications/new
* 
*/

$config['soundcloud_key']          		= 'e865c40cd8e163918594db283501b306'; 
$config['soundcloud_secret']       		= 'a218bcb85e7d82c6fc287342a739237d'; 
$config['soundcloud_callback_url'] 		= 'http://ored.net/music/'; 
$config['soundcloud_tmp_path']    	 	= $_SERVER['DOCUMENT_ROOT'].'uploads'; 
$config['soundcloud_playlist_route']	= "http://api.soundcloud.com/playlists/10225031.json?client_id=e865c40cd8e163918594db283501b306";
?>