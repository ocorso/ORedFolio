<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Site specific constants
|--------------------------------------------------------------------------
|
*/

switch (SITE) {
	case 'cfm':
		define("FB_APP_ID", "385637378204897");
		define("FB_APP_SECRET", "125fa60c987b92a863f489ad377389fc");
		define("SITE_TITLE", "Clickfire Media");
		define("SITE_DESCRIPTION", "Compelling, shareable content has become the primary catalyst for interactions between brands and consumers. Clickfire Media creates digital engagements.");
		break;
	case 'r2b':
		define("FB_APP_ID", "201511586639916");
		define("FB_APP_SECRET", "171daff7d5f2fb0b0da16a652b64ffe6");
		define("SITE_TITLE", "Raison D'Être");
		define("SITE_DESCRIPTION", "Compelling, shareable content has become the primary catalyst for interactions between brands and consumers. Raison D'etre creates digital engagements and video content focusing on fashion, luxury, and beauty brands.");
		break;
	default: //c3x
		define("FB_APP_ID", "144438949083813");
		define("FB_APP_SECRET", "4c04e32ffb27cffd9e5fcbbdcf49428c");
		define("SITE_TITLE", "Click 3X");
		define("SITE_DESCRIPTION", "Compelling, shareable content has become the primary catalyst for interactions between brands and consumers. Click 3X creates digital engagements and video content.");
		break;
		break;
}

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */