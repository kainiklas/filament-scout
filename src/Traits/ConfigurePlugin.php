<?php

namespace Kainiklas\FilamentScout\Traits;

trait ConfigurePlugin
{
    // use EvaluatesClosures;

    protected bool $useMeiliSearch = false;

    // protected bool $useScoutInSelect = false;

    public function useMeiliSearch(bool $condition = true): static
    {
        $this->useMeiliSearch = $condition;

        return $this;
    }

    public function getUseMeiliSearch(): bool
    {
        return $this->useMeiliSearch;
    }
}
