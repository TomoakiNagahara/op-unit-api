<?php
/** op-unit-api:/include/GetRequestFromHash.inc.php
 *
 * @created    2024-02-09
 * @version    1.0
 * @package    op-unit-api
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP\UNIT\API;

//	...
$request = OP()->Request();

//	...
if( $hash = $request['_HASH_'] ?? null ){
	$json = apcu_fetch($hash);

	//	...
	if( $json ){
		$request = json_decode($json, true);
	}else{
		self::Error("This hash value data has not saved. ($hash)");
	}
}else{
	//	...
	$json = json_encode($request);

	//	...
	$hash = md5(__FILE__.', '.__LINE__.', '.$json);
	$hash = substr($hash, 0, 8);

	//	Return to hash.
	self::Admin('hash', $hash);

	//	Create new data. Not overwrite.
	apcu_add($hash, $json);
}

//	...
return $request;
