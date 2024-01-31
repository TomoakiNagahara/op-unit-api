Api::GetRequestFromHash()
===

  Cache the request values on the server side.
  The stored value can be recalled using the hash key.
  Hash keys can be passed in URL queries.

## Usage

  Client side.

```
//  1st time
$url   = 'https://example.com/api/?foo=bar';
$json = Fetch($url);
var_dump($json['result']); // ['foo'=>'bar']

//  Get hash key of saved request.
$hash = $json['hash'];

//  2nd time
$url   = "https://example.com/api/?_HASH_={$hash}";
$json = Fetch($url);
var_dump($json['result']); // ['foo'=>'bar']
```

  Server side.

```php
<?php
/* @var $api \OP\UNIT\Api */
$api = OP()->Unit('Api');

//  Get request values.
$request = $api->GetRequestFromHash()

//  Return request values.
$api->Result($request);
```
