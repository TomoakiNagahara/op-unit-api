<?php
/** op-unit-api:/include/sleep.inc.php
 *
 * @created   2021-01-21
 * @version   1.0
 * @package   op-unit-api
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP\UNIT\API;

/** use
 *
 */
use OP\Config;
use OP\UNIT\Api;

/*
//	Not admin.
if(!Env::isAdmin() ){
	return;
}

//	Not localhost
if(!Env::isLocalhost() ){
	return;
}
*/

//	Get config.
$date = Config::Get('api')['sleep']['skipdate'] ?? null;

//	Check config.
if( $date and $date === Date('Y-m-d', OP()->Time()) ){
	$sleep = 0;
}else

//	This is causing a delay on purpose.
if( $sleep = (int)($_REQUEST['sleep'] ?? rand(0, 2000000)) ){
	usleep($sleep);
};

//	...
Api::Admin('sleep', bcdiv($sleep, 1000000, 7));
