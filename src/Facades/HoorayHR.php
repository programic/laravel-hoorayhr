<?php

namespace Programic\Hooray\Facades;

use Illuminate\Support\Facades\Facade;

class HoorayHR extends Facade
{

    /**
     * Get a task builder instance.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        return 'hoorayhr';
    }
}
