<?php
/** op-unit-api:/function/Sleep.php
 *
 * @creation  2021-01-18
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
use OP\Env;
use OP\Config;
use OP\UNIT\Api;

/** Calculate sleep time.
 *
 */
function Sleep()
{
	//	Get config.
	$date = Config::Get('api')['sleep']['skipdate'] ?? null;

	//	Check config.
	if( $date === Date('Y-m-d', Env::Time()) ){
		$sleep = 0;
	}else

	//	This is causing a delay on purpose.
	if( $sleep = (int)($_REQUEST['sleep'] ?? rand(0, 2000000)) ){
		usleep($sleep);
	};

	//	...
	Api::Admin('sleep', bcdiv($sleep, 1000000, 7));
}
