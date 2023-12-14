<?php

namespace Kainiklas\FilamentScout;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Kainiklas\FilamentScout\Providers\MeilisearchGlobalSearchProvider;

class FilamentMeilisearchPlugin implements Plugin
{
    public function getId(): string
    {
        return 'kainiklas-filament-scout';
    }

    public function register(Panel $panel): void
    {
        $panel->globalSearch(MeilisearchGlobalSearchProvider::class);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
