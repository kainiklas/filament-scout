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

        $searchLimit = config('kainiklas-filament-scout.search_limit');
        $primaryKeyName = app($this->getModel())->getKeyName();

        $keys = $this->getModel()::search($search)
            ->query(function ($query) use ($primaryKeyName) {
                $query->select($primaryKeyName);
            })
            ->paginate($searchLimit, page: 1) // use first page, pagination is done later
            ->pluck($primaryKeyName);

        return $query->whereIn($primaryKeyName, $keys);
    }
}
