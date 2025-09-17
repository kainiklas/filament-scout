<?php

namespace Kainiklas\FilamentScout\Providers;

use Filament\GlobalSearch\Providers\Contracts\GlobalSearchProvider;
use Exception;
use Filament\Facades\Filament;
use Filament\GlobalSearch\GlobalSearchResult;
use Filament\GlobalSearch\GlobalSearchResults;
use Illuminate\Database\Eloquent\Model;

class ScoutGlobalSearchProvider implements GlobalSearchProvider
{
    public function getResults(string $query): ?GlobalSearchResults
    {
        $builder = GlobalSearchResults::make();

        foreach (Filament::getResources() as $resource) {
            if (! $resource::canGloballySearch()) {
                continue;
            }

            if (! method_exists($resource::getModel(), 'search')) {
                throw new Exception('The model is not searchable. Please add the Laravel Scout trait Searchable to the model.');
            }

            $search = $resource::getModel()::search($query);

            $resourceResults = $search
                ->get()
                ->map(function (Model $record) use ($resource): ?GlobalSearchResult {
                    $url = $resource::getGlobalSearchResultUrl($record);

                    if (blank($url)) {
                        return null;
                    }

                    return new GlobalSearchResult(
                        title: $resource::getGlobalSearchResultTitle($record),
                        url: $url,
                        details: $resource::getGlobalSearchResultDetails($record),
                        actions: $resource::getGlobalSearchResultActions($record),
                    );
                })
                ->filter();

            if (! $resourceResults->count()) {
                continue;
            }

            $builder->category($resource::getPluralModelLabel(), $resourceResults);
        }

        return $builder;
    }
}
