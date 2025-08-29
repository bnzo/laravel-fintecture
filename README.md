
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
    'environement' => env('FINTECTURE_ENVIRONMENT', 'sandbox'), // sandbox or production
    'private_key' => env('FINTECTURE_PRIVATE_KEY') // base64 encoded private key
];
```

## Usage

### Create a RequestToPay URL

This is a simple call using a basic PaymentRequestData object.\
Please refer to the next section if you need more payment parameters such as currency, expiration time, and method ( link, sms, email ).

```php
use Bnzo\Fintecture\Data\PaymentRequestData;
use Bnzo\Fintecture\Facades\Fintecture;

$paymentData = new PaymentData(
        new AttributesData(
            amount: '272.00',
            communication: 'test'
        ),
        new CustomerData(
            psu_email: 'julien.lefebre@my-business-sarl.com',
            psu_name: 'Julien Lefebvre'
        )
    );

$sessionData = Fintecture::generate(
    paymentData: $paymentData
    redirectUri: 'https://redirect.uri', 
);

$sessionData->sessionId; //d2e30e2c0b9e4ce5b26f59dc386b21b2
$sessionData->url; //https://fintecture.com/v2/85b0a547-5c18-4a16-b93b-2a4f5f03127d
```

### Create a PaymentRequestData

Not all data fields are mandatory, please refer to each Data classes to see what you can use and what are default values.

```php
use Bnzo\Fintecture\Data\PaymentData;

$paymentRequestData = new PaymentData(
    new AttributesData(
        amount: '272.00',
        communication: 'test',
        currency: Currency::EUR, // default EUR
    ),
    new CustomerData(
        psu_email: 'julien.lefebre@my-business-sarl.com',
        psu_name: 'Julien Lefebvre',
        psu_address: new AddressData(
            street: '1 rue de la paix',
            zip: '75000',
            city: 'Paris',
            country: 'FR',
        ),
    ),
    new SettingsData(
        permanent: false, // default false
        expiry: 86400, // default 84000
        due_date: 86400, // default 84000
        scheduled_expiration_policy: ScheduledExpirationPolicy::Immediate, // default Immediate
        method: Method::Link // default Link
    ),
);
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
