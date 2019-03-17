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
use OP\Time;
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
	private $_json;

	/** Construct.
	 *
	 */
	function __construct()
	{
		$this->_json['status'] = true;
		$this->_json['errors'] = null;
		$this->_json['result'] = null;
		$this->_json['timestamp'] = Time::Datetime();
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
		if( $this->_json['status'] ?? null ){
			//	...
			if(!($_GET['html'] ?? null) ){
				//	...
				Env::Set('layout',['execute'=>false]);

				//	...
				echo json_encode($this->_json);
			}else{
				D($this->_json);
			};

			//	...
			unset($this->_json);
		}
	}
}
