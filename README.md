Api
===

## Usage

### Instantiate

```php
/* @var $api \OP\UNIT\Api */
$api = OP()->Unit('Api');
```

### Set

 Set value by key.

```php
$api->Set('user_id',$user_id);
```

### Get

 Get value by key.

```php
$user_id = $api->Get('user_id');
```

### Out

 Output Json string.
 This method is automatically adjust MIME.

```php
$api->Out();
```

### Error

 Set error message for end user.

```php
$api->Error('This is test1.');
$api->Error('This is test2.');
```

### Admin

 Only added if `Env::isAdmin()` is true.

```php
$api->Admin('file', __FILE__);
```

```php
/* @var $api \OP\UNIT\Api */
$api = OP()->Unit('Api');

//  Set value.
$api->Set('user_id',$user_id);

//  The error will be included in the JSON, perfect for handling in the browser.
$api->Error('This is test1.');

//  This is the Notice to the administrator. It is not included in the JSON.
OP()->Notice('This is a notice to admin only.');

// Output the JSON.
$api->Out();
```

### localhost

 If `OP()->isLocalhost()` is `true`, the following items are enabled.

 * The admin field is added to the JSON and the status of the request is returned, which can help developers with debugging.
 * Waits for a request. The number of seconds to sleep can be passed in the request. The default is random. This allows you to test for asynchronous communication failures in advance.

### Display of html table format

 Add `html=1` to the URL query.
