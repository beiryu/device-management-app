<?php

namespace App\Exceptions;

use Exception;

class GetSocialUserException extends Exception
{
    //
    public function report()
    {
        \Log::debug("Sorry, something were wrong!");
    }

    public function render($request)
    {
        return response()->view('errors.get-social-user');
    }
}
