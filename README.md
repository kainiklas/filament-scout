# This is my package filament-scout

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kainiklas/filament-scout.svg?style=flat-square)](https://packagist.org/packages/kainiklas/filament-scout)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/kainiklas/filament-scout/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/kainiklas/filament-scout/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/kainiklas/filament-scout/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/kainiklas/filament-scout/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/kainiklas/filament-scout.svg?style=flat-square)](https://packagist.org/packages/kainiklas/filament-scout)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require kainiklas/filament-scout
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-scout-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-scout-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-scout-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentScout = new Kainiklas\FilamentScout();
echo $filamentScout->echoPhrase('Hello, Kainiklas!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Kai Niklas](https://github.com/kainiklas)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
