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
            $getInfo = $this->getUserFromFlatform($platform);
        } catch (GetSocialUserException $exception) {
            throw $exception;
        }
        $user = $this->createUser($getInfo);
        auth()->login($user); 
        return true;
    }
}