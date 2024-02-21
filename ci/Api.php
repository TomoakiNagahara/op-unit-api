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
$result =  'Success!';
$args   = ['ci.phtml',['arg1'=>'Success!']];
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
	'timestamp' => OP()->Timestamp(),
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
if( \OP\UNIT\CI::Dryrun() ){
	$result['dry-run'] = '1';
}
if( $unit = OP()->Request('unit') ){
	$result['unit'] = $unit;
}
$args   = '';
$ci->Set('Request', $result, $args);

//	GetRequestFromHash
$args   = '';
$ci->Set('GetRequestFromHash', $result, $args);

//	...
return $ci->GenerateConfig();
