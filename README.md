# GoFax SOAP PHP SDK

This SDK provides simple access to the GoFax SOAP API. 
It currently handles the following requests

- List SOAP functions
- Get list of received faxes
- Get fax data for a given fax


## Contents

- [Getting started](#getting-started)
- [Integrating with Laravel](#integrating-with-laravel)

## Getting started

Install the SDK into your project using Composer.

```bash
composer require heshanh/gofax
```

## Integrating with Laravel

This package ships with a Laravel specific service provider which allows you to set your credentials from your configuration file and environment.

### Registering the provider

Add the following to the `providers` array in your `config/app.php` file.

```php
heshanh\GoFax\LaravelServiceProvider::class
```

### Adding config keys

In your `config/services.php` file, add the following to the array.

```php
'gofax'=> [
        'api_url' => env('FAX_API_URL'),
        'api_key' => env('FAX_API_KEY'),

    ]
```

### Adding environment keys

In your `.env` file, add the following keys.

```ini
FAX_API_KEY=
FAX_API_URL=

```

### Resolving a client

To resolve a client, you simply pull it from the service container. This can be done in a few ways.

#### Dependency Injection

```php
use heshanh\GoFax;

public function yourControllerMethod(SoapClient $client) {
    // Call methods on $client
}
```

#### Using the `app()` helper

```php
use heshanh\GoFax;

public function anyMethod() {
    $client = app(SoapClient::class);
    // Call methods on $client
}
```

### Available methods

```
$client->getFunctions()

$client->getReceivedFaxes()

$client->getFaxDataFromId($faxId)

```

Refer to the GoFax API documentation for further information
https://www.gofax.com.au/fax-api/


### Testing

Coming soon