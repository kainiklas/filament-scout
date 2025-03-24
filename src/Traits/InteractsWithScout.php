<?php

namespace Kainiklas\FilamentScout\Traits;

use Illuminate\Database\Eloquent\Builder;

trait InteractsWithScout
{
    protected function applySearchToTableQuery(Builder $query): Builder
    {
        $this->applyColumnSearchesToTableQuery($query);

        $search = $this->getTableSearch();

        if (blank($search)) {
            return $query;
        }

        $searchLimit = config('kainiklas-filament-scout.scout_search_limit');
        $keys = $this->getModel()::search($search)->take($searchLimit)->keys();

        return $query->whereKey($keys);
    }
}
