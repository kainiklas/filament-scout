<?php

namespace Concept7\FilamentScout;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Concept7\FilamentScout\Providers\MeilisearchGlobalSearchProvider;
use Concept7\FilamentScout\Providers\ScoutGlobalSearchProvider;
use Concept7\FilamentScout\Traits\ConfigurePlugin;

class FilamentScoutPlugin implements Plugin
{
    use ConfigurePlugin;

    public function getId(): string
    {
        return 'kainiklas-filament-scout-plugin';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        // Global Search Provider
        if ($this->getUseMeiliSearch()) {
            $panel->globalSearch(MeilisearchGlobalSearchProvider::class);
        } else {
            $panel->globalSearch(ScoutGlobalSearchProvider::class);
        }
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
