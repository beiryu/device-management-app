<?php
namespace App\Repositories;

use App\Models\Device;
use App\Models\AppConst;
use App\Models\User;

trait DeviceRepository {
    
    public function relatedDevices($device) {
        return $device->type->devices()->where('id', '!=', $device->id)->latest()->take(AppConst::RELATED_DEVICE)->get();
    }

    public function getDevicesOfUser($user_id) {
        return User::with('devices')->where('id', $user_id)->first();
    }
}