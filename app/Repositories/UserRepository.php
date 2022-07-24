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
        Auth::loginUsingId(($id));
    }

    public function getFirstOrNew($user) {
        return User::firstOrNew(
            ['facebook_id' => ($user->id)],
            [
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => AppConst::USER_ID,
            ]
        );
    }

    public function createUser($getInfo) {
        $user = User::where('facebook_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'role_id' => AppConst::USER_ID,
                'facebook_id' => ($getInfo->id)
            ]);
        }
        return $user;
    }

    public function getUserHired() {
        return DB::table('device_user')
        ->select('user_id')
        ->distinct()
        ->get();  
    }
}