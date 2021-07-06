# Bigmsgbox notifications channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/owenoj/laravel-bigmsgbox.svg?style=flat-square)](https://packagist.org/packages/owenoj/laravel-bigmsgbox)
[![Total Downloads](https://img.shields.io/packagist/dt/owenoj/laravel-bigmsgbox.svg?style=flat-square)](https://packagist.org/packages/owenoj/laravel-bigmsgbox)

This package makes it easy to send Bigmsgbox sms notifications with Laravel 8+

## Installation

You can install the package via composer:

```bash
composer require owenoj/laravel-bigmsgbox
```
## Configuration

```bash
BIGMSGBOX_API_KEY=ABXCDSD
BIGMSGBOX_API_SECRET=HFHFK992
BIGMSGBOX_SENDERID=MyCompany
```
## Usage
Now you can use the channel in your via() method inside the notification:


```php
use Owenoj\LaravelBigmsgbox\BigmsgboxChannel;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [BigmsgboxChannel::class];
    }

    public function toBigmsgbox($notifiable)
    {
        return "Your  account was approved!";//your message
    }
}
```
You can also send sms via Facade like so:
```php
namespace App\Http\Controllers;

use Owenoj\LaravelBigmsgbox\Bigmsgbox;
use Illuminate\Notifications\Notification;

class AccountController extends Controller
{
    
    public function sendsms()
    {
        $message = "Your  account was approved!";
        $to = '2331234567890';
        return Bigmsgbox::send($to,$message);
    }
}
```
 In order to let your Notification know which phone are you sending to, the channel will look for the phone_number attribute of the Notifiable model. If you want to override this behaviour, add the **routeNotificationForBigmsgbox** method to your Notifiable model.
```php

public function routeNotificationForBigmsgbox()
{
    return '2331234567890';
}

```
### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email owen.j@terktrendz.com instead of using the issue tracker.

## Credits

-   [Owen Jubilant ](https://github.com/owenoj)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
