# ABN Lookup Laravel Package

This SDK provides simple access to the ABN Lookup service. 
It currently handles the following requests

- List SOAP functions
- Search for an ABN



## Contents

- [Getting started](#getting-started)
- [Integrating with Laravel](#integrating-with-laravel)

## Getting started

Install the SDK into your project using Composer.

You'll need to register with the ABR to get a GUID - http://abr.business.gov.au/RegisterAgreement.aspx

```bash
composer require heshanh/abn
```

## Integrating with Laravel

This package ships with a Laravel specific service provider which allows you to set your credentials from your configuration file and environment.

### Registering the provider

Add the following to the `providers` array in your `config/app.php` file.

```php
heshanh\Abn\LaravelServiceProvider::class
```

### Adding config keys

In your `config/services.php` file, add the following to the array.

```php
 'abn' => [
        'service_url' => env('ABN_SERVICE_URL'),
        'guid' => env('ABN_GUID')
    ]
```

### Adding environment keys

In your `.env` file, add the following keys.

```ini
ABN_SERVICE_URL=
ABN_GUID=

```

### Resolving a client

To resolve a client, you simply pull it from the service container. This can be done in a few ways.

#### Dependency Injection

```php
use heshanh\Abn;

public function yourControllerMethod(SoapClient $client) {
    // Call methods on $client
}
```

#### Using the `app()` helper

```php
use heshanh\Abn;

public function anyMethod() {
    $client = app(SoapClient::class);
    // Call methods on $client
}
```

### Available methods

```
$client->getFunctions()

$client->search($abn,  $params)

```

```php
        try {

            $client = app(SoapClient::class);
            $response = $client->search(51824753556, ['includeHistoricalDetails' => 'N']);

            if (isset($response->ABRPayloadSearchResults->response->exception)) {
                $response = json_encode($response->ABRPayloadSearchResults->response->exception);
            }

        } catch (\Exception $e) {
            //Error!
        }
```

### Testing

Coming soon