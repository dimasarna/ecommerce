# Laravel ecommerce platform

Fully functional ecommerce platform buit based on [Aimeos](https://aimeos.org) framework that aims for high performance ecommerce platform.

## Features

Aimeos is a full-featured e-commerce package:

* Multi vendor, multi channel and multi warehouse
* From one to 1,000,000,000+ items
* Extremly fast down to 20ms
* For multi-tentant e-commerce SaaS solutions
* Bundles, vouchers, virtual, configurable, custom and event products
* Subscriptions with recurring payments
* 100+ payment gateways
* Full RTL support (frontend and backend)
* Block/tier pricing out of the box
* Extension for customer/group based prices
* Discount and voucher support
* Flexible basket rule system
* Full-featured admin backend
* Beautiful admin dashboard
* Configurable product data sets
* JSON REST API based on jsonapi.org
* Completly modular structure
* Extremely configurable and extensible
* Extension for market places with millions of vendors
* Fully SEO optimized including rich snippets
* Translated to 30+ languages
* AI-based text translation
* Optimized for smart phones and tablets
* Secure and reviewed implementation
* High quality source code

... and [more Aimeos features](https://aimeos.org/features)

With added 2 extensions:
* Calculate shipping price based on city, thanks to [RajaOngkir](https://rajaongkir.com) API.
* Integrate with [Midtrans](https://midtrans.com) payment gateway through [Omnipay](https://github.com/thephpleague/omnipay).

## Table of content

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Frontend](#frontend)
- [Backend](#backend)
- [Customize](#customize)
- [Multi-vendor](#multi-vendor)
- [License](#license)
- [Links](#links)

## Requirements

The Aimeos shop distribution requires:
- Linux/Unix, WAMP/XAMP or MacOS environment
- PHP >= 7.3
- MySQL >= 5.7.8, MariaDB >= 10.2.2
- Web server (Apache, Nginx or integrated PHP web server for testing)

If required PHP extensions are missing, `composer` will tell you about the missing
dependencies.

## Installation

To install this application, you need [composer 2.1+](https://getcomposer.org).
For composer installation go to composer [download](https://getcomposer.org/download) page.

The first step is to clone this repository and run:

```
composer install
```

**Note:** Before run `composer install` command please make copy of folder `vendor` spesifically `vendor/aimeos` so you can replace vendor folder after the `composer install` command. This is because some code are writed on top of composer packages, if you run `composer install` command without backup `vendor` folder the composer will reset the change that happen in the `vendor` folder.

Secondly you need to change the parameters of your database and mail server in `.env` file, then run:

```
php artisan key:generate
php artisan migrate
```

In a local environment, you can use the integrated PHP web server to test your new
installation. Simply execute the following command to start the web server:

```
php artisan serve
```

**Note:** In an hosting environment, the document root of your virtual host must point to
the **/.../myshop/public/** directory and you have to change the `APP_URL` setting in your `.env`
file to your domain without port, e.g.:

```
APP_URL=http://myhostingdomain.com
```

## Configuration

For setup RajaOngkir service you need to have API key from RajaOngkir website. API key is hard-coded in `vendor/aimeos/aimeos-core/lib/mshoplib/src/MShop/Service/Provider/Decorator/RajaOngkir.php`.

To create new shipping service, say POS Indonesia, you need to go to administration interface page and select **Services** then add new service. After that configure available option and don't forget to add RajaOngkir as decorator.

For configuring Midtrans related settings you need to go to administration interface page and select **Services** then select **Midtrans**. After that configure available option such as **Server Key** and **Test Mode**.

**Good to notice** that this application using Midtrans built-in snap for handling payment. For usage and documentation please refer to Midtrans [docs](https://docs.midtrans.com) page.

## Frontend

After the installation, you can test the Aimeos shop frontend by calling the URL of your
VHost in your browser. If you use the integrated PHP web server, you should browse
this URL: [http://127.0.0.1:8000](http://127.0.0.1:8000)

[![Aimeos frontend](https://aimeos.org/fileadmin/aimeos.org/images/aimeos-frontend.jpg?2021.07)](http://laravel.demo.aimeos.org/)

## Backend

The Aimeos administration interface will be available at `/admin` in your VHost. When using
the integrated PHP web server, call this URL: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin).

Login with this default admin account:

E-mail: admin@example.com
Password: demo

[![Aimeos admin backend](https://aimeos.org/fileadmin/aimeos.org/images/aimeos-backend.png?2021.04)](http://admin.demo.aimeos.org/)

## Customize

Laravel and the Aimeos e-commerce package are extremely flexible and highly customizable.
A lot of documentation for the [Laravel framework](https://laravel.com) and the
[Aimeos e-commerce framework](https://aimeos.org/docs/latest/laravel) exists. If you have questions
about Aimeos, don't hesitate to ask in our [Aimeos forum](https://aimeos.org/help/).

For more details about Aimeos Laravel integration, please have a look at its
[repository](https://github.com/aimeos/aimeos-laravel).

## Multi-language

For shops which offers multiple languages, just add this line to your `./myshop/.env` file:

```
SHOP_MULTILOCALE=true
```

Then, the language will be added to the routes automatically. You can set up the available
languages in the ["Locale > Locale" panel](https://aimeos.org/docs/latest/manual/locales/)
of the Aimeos admin backend.

## Multi-vendor

To enable multi-vendor features, add this settings to the `./myshop/.env` file:

```
SHOP_MULTISHOP=true
```

If you want to allow vendors to register themselves as sellers, set this option in the
`./myshop/.env` file too:

```
SHOP_REGISTRATION=true
```

By default, newly registered sellers have administrator privileges in the backend for
their own site. For a more limited access to the backend, you can change the permission
level to "editor" in the `./myshop/.env` file:

```
SHOP_PERMISSION=editor
```

You can change the permissions associated to "admin" or "editor" by adding your own version
of the [JQAdm resource configuration](https://github.com/aimeos/ai-admin-jqadm/blob/master/config/admin/jqadm/resource.php)
to the "admin" section of your `./config/shop.php` file.

## License

The Aimeos shop system is licensed under the terms of the MIT and LGPLv3 license and
is available for free.

## Links

* [Web site](https://aimeos.org/Laravel)
* [Documentation](https://aimeos.org/docs/latest/laravel)
* [Forum](https://aimeos.org/help/laravel-package-f18/)
* [Issue tracker](https://github.com/aimeos/aimeos/issues)
* [Composer packages](https://packagist.org/packages/aimeos/aimeos)
* [Source code](https://github.com/aimeos/aimeos)
