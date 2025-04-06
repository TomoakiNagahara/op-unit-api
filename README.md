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

### Display of html table format

 Add `html=1` to the URL query.
