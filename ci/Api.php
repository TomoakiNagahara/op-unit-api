<?php
/** op-unit-api:/ci/Api.php
 *
 * @created     2024-02-18
 * @version     1.0
 * @package     op-unit-api
 * @author      Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright   Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

/* @var $ci UNIT\CI */
$ci = OP::Unit('CI');

//	Config
$config = [
	'sleep' => [
		'skipdate' => date(_OP_DATE_, OP::Time()),
	],
];
OP::Config('api', $config);

//	Template
$arg1   = 'foo';
$arg2   = 'bar';
$args   = ['ci.phtml',['arg1'=>$arg1, 'arg2'=>$arg2]];
$result = $arg1 . $arg2;
$ci->Set('Template', $result, $args);

//	Admin
$result =  null;
$args   = ['CI', true];
$ci->Set('Admin', $result, $args);

//	Set
$result =  null;
$args   = ['key','value'];
$ci->Set('Set', $result, $args);

//	Get
$result =  'value';
$args   = ['key'];
$ci->Set('Get', $result, $args);

//	Out
$json = [
	'status' =>  true,
	'errors' => [null],
	'result' =>  null,
	'timestamp' => date(_OP_DATE_TIME_, $_SERVER['REQUEST_TIME']),
	'admin'  => [
		'endpoint' => null,
		'get'   => [],
		'post'  => [],
		'CI'    => true,
		'dump'  => [null],
		'sleep' => '0.0000000',
	],
];
$result =  json_encode($json);
$args   =  null;
$ci->Set('Out', $result, $args);

//	Request
$result = [];
foreach( $_SERVER['argv'] as $arg ){
	//	...
	if(!strpos($arg, '=') ){
		continue;
	}
	//	...
	list($key, $var) = explode('=', $arg);
	$result[$key] = escapeshellcmd($var);
}
$args   = '';
$ci->Set('Request', $result, $args);

//	GetRequestFromHash
$args   = '';
$ci->Set('GetRequestFromHash', $result, $args);

//	...
return $ci->GenerateConfig();
