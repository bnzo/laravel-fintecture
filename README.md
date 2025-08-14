
<p align="center"><img src="/art/logo.png" height="100" alt="Laravel Telemaque"></p>

<div align="center">


# Laravel Fintecture
An opinionated Fintecture wrapper for Laravel apps.

[![Coding Standards Action Status](https://github.com/bnzo/laravel-fintecture/workflows/coding-standards/badge.svg)](https://github.com/bnzo/laravel-fintecture/actions/workflows/coding-standards.yml)
[![Static Analysis Action Status](https://github.com/bnzo/laravel-fintecture/workflows/static-analysis/badge.svg)](https://github.com/bnzo/laravel-fintecture/actions/workflows/static-analysis.yml)
[![Tests Action Status](https://github.com/bnzo/laravel-fintecture/workflows/tests/badge.svg)](https://github.com/bnzo/laravel-fintecture/actions/workflows/tests.yml)

</div>

## ⚠️ This package is under developement, do not use it in production. ⚠️


## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-fintecture.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-fintecture)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require bnzo/laravel-fintecture
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-fintecture-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-fintecture-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-fintecture-views"
```

## Usage

```php
$fintecture = new Bnzo\Fintecture();
echo $fintecture->echoPhrase('Hello, Bnzo!');
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
