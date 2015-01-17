<?php

namespace Twosuperior\Screenshot\Facades;

use Illuminate\Support\Facades\Facade;

class Screenshot extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
	protected static function getFacadeAccessor() { return 'screenshot'; }
}
