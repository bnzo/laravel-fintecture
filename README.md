
<p align="center"><img src="/art/logo.png" height="100" alt="Laravel Telemaque"></p>

<div align="center">


# Laravel Fintecture
An opinionated Fintecture wrapper for Laravel apps.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bnzo/laravel-fintecture.svg?style=flat-square)](https://packagist.org/packages/bnzo/laravel-fintecture)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bnzo/laravel-fintecture/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bnzo/laravel-fintecture/actions/workflows/tests.yml)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bnzo/laravel-fintecture/static-analysis.yml?branch=main&label=static-analysis&style=flat-square)](https://github.com/bnzo/laravel-fintecture/actions/workflows/static-analysis.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/bnzo/laravel-fintecture/coding-standards.yml?branch=main&label=coding%20standards&style=flat-square)](https://github.com/bnzo/laravel-fintecture/actions/workflows/coding-standards.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/bnzo/laravel-fintecture.svg?style=flat-square)](https://packagist.org/packages/bnzo/laravel-fintecture)

## ⚠️ Package under developement, do not use it in production. ⚠️
</div>



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
            email: 'julien.lefebre@my-business-sarl.com',
            name: 'Julien Lefebvre'
        )
    );

$sessionData = Fintecture::generate(
    paymentData: $paymentData
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
        communication: 'Order #1',
        currency: Currency::EUR, // default Currency::EUR
        language: 'en' //default App::getLocale()
        state: "1" //default null
    ),
    new CustomerData(
        email: 'julien.lefebre@my-business-sarl.com',
        name: 'Julien Lefebvre',
        address: new AddressData(
            street: '1 rue de la paix',
            zip: '75000',
            city: 'Paris',
            country: 'FR',
        ),
    ),
    new SettingsData(
        dueAt: now()->addDay(), // default 24h
        expiresAt: now()->addDay(), // default 24h
        method: Method::Link // default Link
        permanent: false, // default false
        redirectUri: "https://myapp.test/finctecture/callback" //default null
        scheduled_expiration_policy: ScheduledExpirationPolicy::Immediate, // default Immediate
    ),
);
```

### Webhooks
Webhooks can be receive at this url `/finctecure/webhook`

1. First, make sure to configure the webhook endpoint in your fintecture app:
   
<img width="777" height="280" alt="Screenshot 2025-09-02 at 15 13 12" src="https://github.com/user-attachments/assets/f06a936b-a5ca-428b-a8b8-baa108e4be8a" />

2. Disable CSRF tokens for this route in you bootstrap app.php file:

```php
//bootstrap/app.php
    ...
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            '/fintecture/webhook',
        ]);
    })
    ...
```

3. You can create a listener like so:

```bash
php artisan make:listener -e \\Bnzo\\Fintecture\\Events\\PayementCreated
```

```php
// app/Listeners/ValidateBankTransfer.php
namespace App\Listeners;
use Bnzo\Fintecture\Events\PaymentCreated;

class ValidateBankTransfer
{
    public function handle(PaymentCreated $event): void
    {
        return "payment created for session {$event->sessionId}";
    }
}
```

For now, you can create listeners for the following events, but more can be added in the route file `web.php`

`PaymentCreated` and `PaymentUnsuccessful`


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
