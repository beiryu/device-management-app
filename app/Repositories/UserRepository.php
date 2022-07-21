<?php
namespace App\Repositories;

use App\Models\AppConst;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;


trait UserRepository {

    public function getUserId() {
        return Auth::id();
    }

    public function getUserFromFlatform($platform) {
        return Socialite::driver($platform)->user();
    }
    
    public function loginUsingIdFlatform($id) {
        Auth::loginUsingId(Crypt::decryptString($id));

    }

    public function getFirstOrNew($user) {
        return User::firstOrNew(
            ['facebook_id' => Crypt::encryptString($user->id)],
            [
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => AppConst::USER_ID,
            ]
        );
    }

    public function getUserHired() {
        return DB::table('device_user')
        ->select('user_id')
        ->distinct()
        ->get();  
    }
}