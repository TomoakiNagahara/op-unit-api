<?php
/** op-unit-api:/include/notice.inc.php
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
use OP\Env;
use OP\Notice;
use OP\UNIT\Api;

//	Not admin.
if(!Env::isAdmin() ){
	return;
}

//	Not localhost.
if(!Notice::Has() ){
	return;
}

//	...
$notices = [];

//	...
while( $notice = Notice::Get() ) {
	$notices[] = $notice;
}

//	...
Api::Admin('notice', $notices);
