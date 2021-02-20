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

/** namespace
 *
 */
namespace OP;

//	...
$scheme = 'http';
$domain = $_SERVER['HTTP_HOST'];
$path   = ConvertURL('app:/api/');
$url    = "{$scheme}://{$domain}{$path}";

//	...
$json = Unit('Curl')->Get($url);

//	...
D( json_decode($json, true) );
