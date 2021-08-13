# Programic - HoorayHR API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/programic/laravel-hoorayhr.svg?style=flat-square)](https://packagist.org/packages/programic/laravel-hoorayhr)
![](https://github.com/programic/laravel-hoorayhr/workflows/Run%20Tests/badge.svg?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/programic/laravel-hoorayhr.svg?style=flat-square)](https://packagist.org/packages/programic/laravel-hoorayhr)

This package is a wrapper for the HoorayHR API

### Installation
This package requires PHP 7.2 and Laravel 5.8 or higher.

```
composer require programic/permissions
```

### Setup
Add Hooray credentials to ``config/services.php``

```php
return [
    'hooray' => [
           'username' => env('HOORAY_USERNAME', '')
           'password' => env('HOORAY_PASSWORD', '')
    ],
];
```

And update .env credentials.

### Basic Usage
```php
use Programic\Hooray\HoorayHR;

public function index(HoorayHR $hooray) {
    // Fetch users
    $hooray->getUsers();
    
    // Fetch & filter calendars
    $hooray->getCalenders(['year' => 2021, 'userId' => 1]);
}

```

### Extended Credentials
You can update the HoorayHR credentials per auth user. This is possible to add the following in a Service Provider:
```php
use Programic\Hooray\HoorayHR;

$this->app->resolving(HoorayHR::class, function ($hooray) {
    $hooray->setCredentials('username', 'password');
});
```

### Testing
```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security-related issues, please email [info@programic.com](mailto:info@programic.com) instead of using the issue tracker.

## Credits

- [Rick Bongers](https://github.com/rbongers)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
