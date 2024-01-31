Sleep feature
===

# Overview

## What is the Sleep feature?

  The sleep feature is that delays for a certain amount of time only when Env::isLocalhost() is true.

## Why delay it on purpose?

  When developing in a localhost environment, the server response is fast.
  The purpose is to bring the response speed closer to the production environment.
  This makes it easier to discover defects in asynchronous processing.

# Usage

  This feature happens automatically on localhost.

## I want to disable it

  Set delay time to 0 seconds.

```
https://example.com/api/?sleep=0
```

  Set config of skip sleep date.

```php
$config['sleep']['skipdate] = OP()->Env()->Date();
OP()->Config('Api', $config);
```

# Technical information

1. That's being done at Api::Out().
1. Check if Env::isLocalhost() is true.
1. `include('__DIR__./include/sleep.inc.php');`;
	1. Skip the specified date. For example, I want to disable it just for today.
	1. Calculate the microseconds to delay. You can also request by GET/POST.
	1. Fill in the JSON with the number of microseconds delayed.
