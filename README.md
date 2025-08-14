
<p align="center"><img src="/art/logo.png" height="100" alt="Laravel Telemaque"></p>

<div align="center">


# Laravel Fintecture
An opinionated Fintecture wrapper for Laravel apps.

[![Coding Standards Action Status](https://github.com/bnzo/laravel-fintecture/workflows/coding-standards/badge.svg)](https://github.com/bnzo/laravel-fintecture/actions/workflows/coding-standards.yml)
[![Static Analysis Action Status](https://github.com/bnzo/laravel-fintecture/workflows/static-analysis/badge.svg)](https://github.com/bnzo/laravel-fintecture/actions/workflows/static-analysis.yml)
[![Tests Action Status](https://github.com/bnzo/laravel-fintecture/workflows/tests/badge.svg)](https://github.com/bnzo/laravel-fintecture/actions/workflows/tests.yml)

</div>

## ⚠️ This package is under developement, do not use it in production. ⚠️

## Installation

You can install the package via composer:

```bash
composer require bnzo/laravel-fintecture
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-fintecture-config"
```

This is the contents of the published config file:

```php
return [
    'app_id' => env('FINTECTURE_APP_ID'),
    'app_secret' => env('FINTECTURE_APP_SECRET'),
    'base_url' => env('FINTECTURE_BASE_URL'),
];
```

## Usage

```php
use Bnzo\Fintecture\Facades\Fintecture;

$response = Fintecture::generateUrl();
echo $response->json('meta.session_id');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [bnzo](https://github.com/17174973+bnzo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
