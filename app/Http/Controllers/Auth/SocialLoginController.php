<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialLoginService;

class SocialLoginController extends Controller
{
    private $socialServ;
 
    public function __construct(SocialLoginService $socialServ)
    {
        $this->socialServ = $socialServ;
    }

    /**
     * Access to facebook oauth
     */
    public function goFacebook () {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle callback processing
     */
    public function facebookCallback() {
        return ($this->socialServ->processCallback('facebook')) ? redirect('/') : redirect('/login');
    }
}
