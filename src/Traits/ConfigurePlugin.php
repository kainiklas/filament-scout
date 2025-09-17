<?php

namespace Concept7\FilamentScout\Traits;

trait ConfigurePlugin
{
    protected bool $useMeilisearch = false;

    public function useMeilisearch(bool $condition = true): static
    {
        $this->useMeilisearch = $condition;

        return $this;
    }

    public function getUseMeilisearch(): bool
    {
        return $this->useMeilisearch;
    }
}
