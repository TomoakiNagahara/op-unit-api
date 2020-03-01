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
use OP\Notice;

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

	/** Init
	 *
	 */
	static function _Init()
	{
		//	Init static variable.
		self::$_json['status'] = true;
		self::$_json['errors'] = null;
		self::$_json['result'] = null;
		self::$_json['timestamp'] = date(_OP_DATE_TIME_);

		//	Init admin info.
		self::Admin('endpoint', \OP\Unit::Instantiate('Router')->EndPoint());
		self::Admin('get' , $_GET);
		self::Admin('post', $_POST);

		//	Switch display mime.
		if( $_GET['html'] ?? null ){
			Env::Mime('text/html');
		}else{
			Env::Mime('text/json');
		};
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
			//	This is causing a delay on purpose.
			if( $sleep = (int)($_REQUEST['sleep'] ?? rand(0, 2)) ){
				sleep($sleep);
			};

			//	...
			self::Admin('sleep', $sleep);
		}

		//	...
		Env::Set('layout',['execute'=>false]);

		//	...
		if( Env::isAdmin() and Notice::Has() ){
			//	...
			$notices = [];

			//	...
			while( $notice = Notice::Get() ) {
				$notices[] = $notice;
			}

			//	...
			self::Admin('notice', $notices);
		}

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
