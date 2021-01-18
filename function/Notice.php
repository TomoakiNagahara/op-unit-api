<?php
/** op-unit-api:/function/Notice.php
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
use OP\Notice;
use OP\UNIT\Api;

/** Do notice process.
 *
 */
function Notice()
{
	//	...
	$notices = [];

	//	...
	while( $notice = Notice::Get() ) {
		$notices[] = $notice;
	}

	//	...
	Api::Admin('notice', $notices);
}
