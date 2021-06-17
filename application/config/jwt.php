<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author: takielias
 * Github Repo : https://github.com/takielias/codeigniter-websocket
 * Date: 04/05/2019
 * Time: 09:04 PM
 */
//$config['jwt_key'] = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJss9';
$config['jwt_key'] = 'eyJ0eXAiOiJKV1QiLCJhbGciTWvLUzI1NiJ9IiRkYXRhIg'; //old

/*Generated token will expire in 1 minute for sample code
* Increase this value as per requirement for production
*/
/*
|-----------------------
| JWT Algorithm Type
|--------------------------------------------------------------------------
*/
$config['jwt_algorithm'] = 'HS256';


/*
|-----------------------
| Token Request Header Name
|--------------------------------------------------------------------------
*/
$config['token_header'] = 'authorization';


/*
|-----------------------
| Token Expire Time

| https://www.tools4noobs.com/online_tools/hh_mm_ss_to_seconds/
|--------------------------------------------------------------------------
| ( 1 Day ) : 60 * 60 * 24 = 86400
| ( 1 Hour ) : 60 * 60     = 3600
| ( 1 Minute ) : 60        = 60
*/
$config['token_expire_time'] = 10;