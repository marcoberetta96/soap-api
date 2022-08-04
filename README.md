Zimbra SOAP
===========
This library is a simple Object Oriented wrapper for the Zimbra SOAP API.

## Requirement
* PHP >= 7.4.x,
* [Http Discovery](https://docs.php-http.org/en/latest/discovery.html) library for finding installed clients and message factories,
* [Serializer](https://jmsyst.com/libs/serializer) library for (de-)serializing XML,
* [PHP Enum](https://github.com/myclabs/php-enum) library,
* (optional) PHPUnit to run tests,

## Install
Via Composer
```bash
$ composer require zimbra-api/soap-api
```
or just add it to your `composer.json` file directly.
```javascript
{
    "require": {
        "zimbra-api/soap-api": "*"
    }
}
```

## Basic usage of admin api

```php
<?php

require_once 'vendor/autoload.php';

use Zimbra\Admin\AdminApi;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;

$api = new AdminApi('https://mail.server:7071/service/admin/soap');
$api->auth('username', 'password');
$account = $api->getAccountInfo(new AccountSelector(AccountBy::NAME(), 'username'));
```

From `$api` object, you can access to all zimbra admin api.

## Licensing
[BSD 3-Clause](LICENSE)

    For the full copyright and license information, please view the LICENSE
    file that was distributed with this source code.
