# Filament Scout Plugin

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kainiklas/filament-scout.svg?style=flat-square)](https://packagist.org/packages/kainiklas/filament-scout)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/kainiklas/filament-scout/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/kainiklas/filament-scout/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/kainiklas/filament-scout/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/kainiklas/filament-scout/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/kainiklas/filament-scout.svg?style=flat-square)](https://packagist.org/packages/kainiklas/filament-scout)

![Filament Scout Plugin](https://raw.githubusercontent.com/kainiklas/filament-scout/main/art/filament-scout.jpeg)

<!-- https://banners.beyondco.de/Filament%20Scout.jpeg?theme=light&packageManager=composer+require&packageName=kainiklas%2Ffilament-scout&pattern=plus&style=style_1&description=Laravel+Scout+for+Global+Search%2C+Table+Search+and+Select+Field&md=1&showWatermark=1&fontSize=150px&images=search-circle -->

Plugin to integrate Laravel Scout into Filament Global Search and Table Search. Plus a ScoutSelect component.

## Pre-Requesites

- [Laravel Scout](https://laravel.com/docs/10.x/scout): Install and configure Laravel Scout as described in the Laravel Docs.

## Installation

You can install the package via composer:

```bash
composer require kainiklas/filament-scout
```

## Table Search

To use Scout Search instead of the default search on a table, add the trait `InteractsWithScout` to any Page which contains a table, e.g. `app\Filament\Resources\MyResource\Pages\ListMyResources.php`:

```php
use Kainiklas\FilamentScout\Traits\InteractsWithScout;

class ListMyResources extends ListRecords
{
    use InteractsWithScout;
}
```

The table defined in the resource needs to be `searchable()` as described in the [Filament table docs](https://filamentphp.com/docs/3.x/tables/advanced#searching-records-with-laravel-scout). Making each column searchable is not required anymore, as the content of what is searchable is defined within scout.

## Global Search

1. Check how to enable [Global Search in the Filament Documentation](https://filamentphp.com/docs/3.x/panels/resources/global-search). 
   - Set a `$recordTitleAttribute` on your resource: [Setting global search result title](https://filamentphp.com/docs/3.x/panels/resources/global-search#setting-global-search-result-titles). 
   - (Optional) Add details by implementing the method `getGlobalSearchResultDetails(Model $record)` in your Resource: [Adding extra details to global search results](https://filamentphp.com/docs/3.x/panels/resources/global-search#adding-extra-details-to-global-search-results).

```php
class ContractResource extends Resource
{
    // required to enable global search
    protected static ?string $recordTitleAttribute = 'name';

    // optional: details
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Category' => $record->category->name,
        ];
    }
}
```

2. Add the Plugin `FilamentScoutPlugin` to your panel configuration, e.g., in `app\Providers\Filament\AdminPanelProvider.php`.

```php
use Kainiklas\FilamentScout\FilamentScoutPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            $plugins([
                FilamentScoutPlugin::make()
            ]);
    }
}
```

### Meilisearch

If you are using [Meilisearch](https://www.meilisearch.com/), you can activate meilisearch specific features (search context highlighting):

1. Configure the plugin.

```php
use Kainiklas\FilamentScout\FilamentScoutPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            $plugins([
                FilamentScoutPlugin::make()
                    ->useMeiliSearch() // enables meilisearch specific features
            ]);
    }
}
```

2. (Optional) Implement/ Adapt `getGlobalSearchResultDetails()` in your Resource:

```php
public static function getGlobalSearchResultDetails(Model $record): array
    {
        // change the filament default implementation from this
        // return [
        //     'AttributeTitle' => $record->attribute_name
        // ];
        
        // to this
        return [
            'scout_attribute_name' => "AttributeTitle"
        ];
    }
```

## Select Form Field

To enable scout search in your select form fields use the provided `ScoutSelect` component:

```php
use Kainiklas\FilamentScout\Forms\Components\ScoutSelect;
 
ScoutSelect::make('company_id')
    ->searchable()
    ->relationship('company', 'name')
    ->useScout() // must be called after relationship()
```

Technically, the `ScoutSelect` component inherits from `Filament\Forms\Components\Select`. The `useScout()` method sets a new  `getSearchResultsUsing()` closure which uses scout.

__Important__: The `useScout()` method needs to be called *after* the relationship method. Otherwise it is overriden by the `relationship()` method.

*Hint*: Only values which are accessible and defined by scout are searchable.

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

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
