<?php

namespace App\Exceptions;

use Exception;

class SearchDeviceException extends Exception
{
    //
    public function report()
    {
        \Log::debug("Sorry, currently there is no device related to that search!");
    }

    public function render($request)
    {
        return response()->view('errors.search-devices');
    }
}
