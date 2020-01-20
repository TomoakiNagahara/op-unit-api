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
use OP\Unit;

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
	private $_json;

	/** Construct.
	 *
	 */
	function __construct()
	{
		//	...
		$this->_json['status'] = true;
		$this->_json['errors'] = null;
		$this->_json['result'] = null;
		/*
		//	Frozen timestamp.
		$this->_json['timestamp'] = Env::Timestamp();
		*/
		//	Real timestamp.
		$this->_json['timestamp'] = date(_OP_DATE_TIME_);

		//	...
		$this->Admin('endpoint', $this->Unit('Router')->EndPoint());
		$this->Admin('get' , $_GET);
		$this->Admin('post', $_POST);
	}

	/** Set for admin only value.
	 *
	 * @param string $key
	 */
	function Admin($key, $val)
	{
		//	...
		if( Env::isAdmin() ){
			$this->_json['admin'][$key] = $val;
		};
	}

	/** Set error message.
	 *
	 * @param string $message
	 */
	function Error($message)
	{
		//	...
		$this->_json['errors'][] = $message;
	}

	/** Get value by key.
	 *
	 * @param string $key
	 */
	function Get($key)
	{
		return $this->_json['result'][$key] ?? null;
	}

	/** Set value by key.
	 *
	 * @param string $key
	 * @param mixed  $val
	 */
	function Set($key, $val)
	{
		$this->_json['result'][$key] = $val;
	}

	/** Output json string.
	 *
	 */
	function Out()
	{
		//	...
		if( $_GET['html'] ?? null ){
			D($this->_json);
			return;
		};

		//	...
		if( Env::isAdmin() ){
			//	...
			while( $notice = \OP\Notice::Get() ){
				$this->_json['notice'][] = $notice;
			}
		}

		//	...
		Env::Mime('text/json');

		//	...
		Env::Set('layout',['execute'=>false]);

		//	...
		echo json_encode($this->_json);
	}
}
