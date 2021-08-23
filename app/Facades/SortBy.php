<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class SortBy extends Facade
{
    public static function getFacadeAccessor()
    {
        return (\App\helpers\SortBy::class);
    }
}

