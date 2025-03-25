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

$config['soundcloud_key']          		= 'f06U4kV8Y2ipTGwe73YmApr9OXfwRWLp'; 
$config['soundcloud_secret']       		= 'eU2HoViIFLO0PDIizRWUAEwus70Vz9wq'; 
$config['soundcloud_callback_url'] 		= 'http://ored.net/music/'; 
$config['soundcloud_tmp_path']    	 	= $_SERVER['DOCUMENT_ROOT'].'uploads'; 
$config['soundcloud_playlist_route']	= "https://api.soundcloud.com/playlists/10225031?show_tracks=true";
?>