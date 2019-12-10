Unit of Api
===

## Usage

### Instantiate

```php
$admin = $app->Unit('Admin');
```

### Set

 Set value by key.

```php
$admin->Set('user_id',$user_id);
```

### Get

 Get value by key.

```php
$user_id = $admin->Get('user_id');
```

### Out

 Output Json string.

```php
$admin->Out();
```

### Admin

 Only added if `Env::isAdmin()` is true.

```php
$admin->Set();
```

### Display of html table format

 Add `html=1` to the URL query.
