<?php

namespace Owenoj\LaravelBigmsgbox;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Owenoj\LaravelBigmsgbox\Skeleton\SkeletonClass
 */
class Bigmsgbox extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-bigmsgbox';
    }
}
