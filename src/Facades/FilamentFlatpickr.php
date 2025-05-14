<?php

namespace Dinakeri\FilamentFlatpickr\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dinakeri\FilamentFlatpickr\FilamentFlatpickr
 */
class FilamentFlatpickr extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Dinakeri\FilamentFlatpickr\FilamentFlatpickr::class;
    }
}
