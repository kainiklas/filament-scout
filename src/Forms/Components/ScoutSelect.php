<?php

namespace Kainiklas\FilamentScout\Forms\Components;

use Closure;
use Filament\Forms\Components\Select as FilamentSelect;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;

class ScoutSelect extends FilamentSelect
{
    public function relationship(string | Closure | null $name = null, string | Closure | null $titleAttribute = null, ?Closure $modifyQueryUsing = null): static
    {
        parent::relationship($name, $titleAttribute, $modifyQueryUsing);

        $this->getSearchResultsUsing(function (ScoutSelect $component, string $search): array {
            $relationship = Relation::noConstraints(fn () => $component->getRelationship());
            $qualifiedRelatedKeyName = $component->getQualifiedRelatedKeyNameForRelationship($relationship);

            return $relationship
                ->getRelated()
                ->search($search, function ($scout, string $query, array $options) {
                    $options['limit'] = $this->getOptionsLimit();

                    return $scout->search($query, $options);
                })
                ->get()
                ->pluck($component->getRelationshipTitleAttribute(), Str::afterLast($qualifiedRelatedKeyName, '.'))
                ->toArray();
        });

        return $this;
    }
}
