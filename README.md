# OrangeMoney
## A Laravel Package for ORANGE MONEY USSD payment api

### INSTALLATION

- Use following command to install:
```
 composer require courage/orangemoneyussd  
```
- Run the following command to publish configuration:
```
php artisan vendor:publish --provider "Courage\OrangeMoney\Provider\UssdOrangeMoneyServiceProvider"
```

### CONFIGURATION

- After installation, you will need to add your orange money settings. As shown bellow you will find in config/orange_money_ussd.php the various parameters, which you should update accordingly.
```php
return [

    /*
    |--------------------------------------------------------------------------
    | Default ORANGE MONEY CREDENTIALS
    |--------------------------------------------------------------------------
    |
    | Here you will need to fill your orange money credential to be abel to
    | start with any process of the payment.
    |
    */

    "OM_USERNAME" => env("OM_USERNAME", ""),

    "OM_PASSWORD" => env("OM_PASSWORD", ""),

    "OM_PIN" => env("OM_PIN", ""),

    "OM_CHANNEL_USER_MSISDN" => env("OM_CHANNEL_USER_MSISDN", ""),

    "OM_X_AUTH_TOKEN" => env("OM_X_AUTH_TOKEN", ""),

    "OM_NOTIF_URL" => env("OM_NOTIF_URL", "https://www.ynote.cm/notification"),
];
```
- Add this to .env.example and .env
```php
OM_USERNAME=
OM_PASSWORD=
OM_PIN=
OM_CHANNEL_USER_MSISDN=
OM_X_AUTH_TOKEN=
OM_NOTIF_URL=
```
### Example usage

#### Make a payment
```php
use Courage\OrangeMoney\Facade\UssdOrangeMoney;

$data = [
          "amount" => 1000,
          "subscriberMsisdn" => "22507070707",
          "orderId" => "123456",
          "notifUrl" => "https://example.com/notify"
        ];

$payment = new UssdOrangeMoney();
$response = $payment->pay($data);


$payToken = $response['pay_token']
```
#### Check transaction status
```php
use Courage\OrangeMoney\Facade\UssdOrangeMoney;

$payment = new UssdOrangeMoney();
$response = $payment->checkTransactionStatus($payToken);
```
## License

The MIT License (MIT). Please see [License](https://github.com/Mahwou/OrangeMoney/blob/main/LICENSE) for more information.

## Contributing

Read [here](https://github.com/Mahwou/OrangeMoney/blob/main/CONTRIBUTING.md) for more information.
