<?php

namespace Bnzo\Fintecture\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bnzo\Fintecture\Fintecture
 */
class Fintecture extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Bnzo\Fintecture\Fintecture::class;
    }
}
