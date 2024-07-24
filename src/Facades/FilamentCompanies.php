<?php

namespace Uchup07\FilamentCompanies\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Uchup07\FilamentCompanies\FilamentCompanies
 */
class FilamentCompanies extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Uchup07\FilamentCompanies\FilamentCompanies::class;
    }
}
