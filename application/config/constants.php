<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');
define('FACEBOOK_APPID', '288958441281557');
define('FACEBOOK_APPSECRET', 'ae0928bf170bbc810cae8dd7b7bc5cc2');
define('FACEBOOK_ACCESS_TOKEN', 'CAAEGzmEZCWBUBALOFYnDU8z3DyPN2HLICZC3avM7hwshheTMQRXN5ZAHwNbvdO3T1It7dK8VvF2ijRkt1Fu1KT20Iqpn9ZCA0RJbMewIMMoIIZBOg226QPwmsw8zBmpOIIDIpOPMzIo6TGHyPlNglVWCGZCEPES26K3eM7W6IZAmDQ95wZCVDKyp8az3oVHmEZBIZD');

/* End of file constants.php */
/* Location: ./application/config/constants.php */