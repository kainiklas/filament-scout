<?php

namespace Kainiklas\FilamentScout\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kainiklas\FilamentScout\FilamentScout
 */
class FilamentScout extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Kainiklas\FilamentScout\FilamentScout::class;
    }
}
