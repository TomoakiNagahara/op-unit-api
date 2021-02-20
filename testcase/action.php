<?php
/** op-unit-api:/testcase/index.php
 *
 * @created   2019-04-02
 * @moved     2019-12-10   Separated from "module-testcase".
 * @version   1.0
 * @package   op-unit-api
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
/* @var $app OP\UNIT\App */
/* @var $api OP\UNIT\Api */
$api = $app->Unit('Api');

//	...
$scheme = 'http';
$domain = $_SERVER['HTTP_HOST'];
$path   = $app->URL('app:/api/');
$url    = "{$scheme}://{$domain}{$path}";

//	...
$json = $app->Unit('Curl')->Get($url);

//	...
D( json_decode($json, true) );
