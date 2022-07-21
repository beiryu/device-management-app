<?php

namespace App\Exceptions;

use Exception;

class SaveDeviceException extends Exception
{
    //
    public function report()
    {
        \Log::debug("Sorry, do not save successfully!");
    }

    public function render($request)
    {
        return response()->view('errors.save-devices');
    }
}
