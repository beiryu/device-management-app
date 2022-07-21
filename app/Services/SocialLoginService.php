<?php
namespace App\Services;

use App\Exceptions\GetSocialUserException;
use App\Repositories\UserRepository;

class SocialLoginService {

    use UserRepository;

    /**
     * Store the user if the user is not exist in storage. 
     * Otherwise We set the user logging.   
     */
    public function processCallback($platform) {
        try {
            $user = $this->getUserFromFlatform($platform);
        } catch (GetSocialUserException $exception) {
            throw $exception;
        }
        $sysUser = $this->getFirstOrNew($user);
        $this->loginUsingIdFlatform($sysUser->facebook_id);
        return true;
    }
}