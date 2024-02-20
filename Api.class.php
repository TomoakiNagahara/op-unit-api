<?php
/** op-unit-api:/Api.class.php
 *
 * @created   2019-03-18
 * @version   1.0
 * @package   op-unit-api
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP\UNIT;

/** Used class.
 *
 */
use OP\Env;
use OP\OP_CI;
use OP\OP_CORE;
use OP\OP_UNIT;
use OP\IF_UNIT;
use OP\IF_API;
/*
use OP\Notice;
use OP\Config;
use function OP\Load;
use function OP\Layout;
*/

/** Api
 *
 * @created   2019-03-18
 * @version   1.0
 * @package   unit-app
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class Api implements IF_UNIT, IF_API
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT, OP_CI;

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
		if( Env::isAdmin() ){
		self::Admin('endpoint', \OP\Unit::Instantiate('Router')->EndPoint());
		self::Admin('get' , $_GET  ?? null);
		self::Admin('post', $_POST ?? null);
		}

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
	 * @param mixed  $val
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
	static function Get($key=null)
	{
		return $key ? (self::$_json['result'][$key] ?? null) : self::$_json;
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

	/** Set result value directly, All over write.
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
		/*
		//	...
		Load('Layout');
		*/

		//	...
		if( $_GET['html'] ?? null ){
			/*
			//	...
			$layout = Config::Get('api')['layout'] ?? 'flexbox';
			Layout($layout);
			*/

			//	...
			D(self::$_json);

			//	...
			return;
		};

		//	Disable layout.
		OP()->Layout(false);

		//	...
		if( Env::isLocalhost() /* and Notice::Has() <-- Why? */ ){
			include(__DIR__.'/include/sleep.inc.php');
		}

		//	...
		if( Env::isAdmin() ){
			include(__DIR__.'/include/notice.inc.php');
		}

		//	...
		echo json_encode(self::$_json);
	}

	/** Get request from
	 *
	 * @created  2022-02-09
	 * @return   array
	 */
	static function Request() : array
	{
		$io = (Env::isAdmin() and OP()->Config('api')['GetRequestFromHash'] ?? null );
		return $io ?
			self::GetRequestFromHash():
			Env::Request();
	}

	/** Get request from hash.
	 *
	 *  This method is for debug.
	 *  The purpose of this feature is reproduce the request across sessions.
	 *
	 *  Requested value is saved to apcu.
	 *  Recovery requested value from given hash value.
	 *
	 * @created 2022-01-22
	 * @return  array
	 */
	static function GetRequestFromHash() : array
	{
		/*
		//	...
		$request = Env::Request();

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
		*/

		//	...
		return include(__DIR__.'/include/GetRequestFromHash.inc.php');
	}
}
