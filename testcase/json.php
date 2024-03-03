<?php
/** op-unit-api:/testcase/json.php
 *
 * @created   2024-02-06
 * @package   op-unit-api
 * @version   1.0
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

//	...
$_GET['html'] = 1;

/* @var $api \OP\UNIT\Api */
$api = OP()->Unit('Api');

//	...
$request = $api->Request();
D($request);

//	...
$api->Result('OK');

//	...
$api->Out();
