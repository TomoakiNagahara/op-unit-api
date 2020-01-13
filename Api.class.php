<?php
/**
 * unit-api:/Api.class.php
 *
 * @creation  2019-03-18
 * @version   1.0
 * @package   unit-api
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @creation  2019-03-18
 */
namespace OP\UNIT;

/** Used class.
 *
 */
use OP\Env;
use OP\OP_CORE;
use OP\OP_UNIT;
use OP\IF_UNIT;

/** Api
 *
 * @creation  2019-03-18
 * @version   1.0
 * @package   unit-app
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class Api implements IF_UNIT
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT;

	/** Store variable.
	 *
	 */
	static private $_json;

	/** Construct.
	 *
	 */
	function __construct()
	{
		self::_Init();
	}

	/** Set for admin only value.
	 *
	 * @param string $key
	 */
	static function Admin($key, $val)
	{
		//	...
		if( Env::isAdmin() ){
			self::$_json['admin'][$key] = $val;
		};
	}

	/** Set dump.
	 *
	 * @param array $dump
	 */
	static function Dump($dump)
	{
		//	...
		if( Env::isAdmin() ){
			self::$_json['admin']['dump'][] = $dump;
		};
	}

	/** Set error message.
	 *
	 * @param string $message
	 */
	static function Error($message)
	{
		//	...
		self::$_json['errors'][] = $message;
	}

	/** Get result value by key.
	 *
	 * @param string $key
	 */
	static function Get($key)
	{
		return self::$_json['result'][$key] ?? null;
	}

	/** Set result value by key.
	 *
	 * @param string $key
	 * @param mixed  $val
	 */
	static function Set($key, $val)
	{
		self::$_json['result'][$key] = $val;
	}

	/** Set result value directly.
	 *
	 * @created  2019-08-29
	 * @param    mixed       $val
	 */
	static function Result($val)
	{
		self::$_json['result'] = $val;
	}

	/** Output json string.
	 *
	 */
	static function Out()
	{
		//	...
		if( $_GET['html'] ?? null ){
			D(self::$_json);
			return;
		};

		//	...
		if( Env::isLocalhost() ){
			//	...
			if( $sleep = $_REQUEST['sleep'] ?? rand(0, 1) ){
				sleep($sleep);
			};

			//	...
			self::Admin('sleep', $sleep);
		}

		//	...
		Env::Set('layout',['execute'=>false]);

		//	...
		echo json_encode(self::$_json);
	}

	/** Help
	 *
	 */
	static function Help()
	{
		echo '<pre>';
		echo self::$_json['admin']['help'] ?? null;
		echo '</pre>';
	}
}
