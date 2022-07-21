<?php

namespace App\Policies;

use App\Models\AppConst;
use App\Models\Device;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DevicePolicy
{
    use HandlesAuthorization;

    /**
     * wheather the user is admin, pass through all
     */
    public function before(User $user) {
        if ($user->role->name === AppConst::SUPPERVISOR) return true;
    }

    /**
     * check before going out device policy
     */
    public function after() {
        return false;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Device $device)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Device $device)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Device $device)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Device $device)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Device $device)
    {
        //
    }

    /**
     * Determine whether the user can see the model, which is pending status.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function pending(User $user, Device $device) {
        //
    }

    public function tracking(User $user, Device $device) {
        //
    }

    /**
     * Determine whether the user can approve the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function approve(User $user, Device $device) {
        //
    }

    /**
     * Determine whether the user can see one's devices.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function myDevices(User $user, Device $device) {

    }

    /**
     * Determine whether the user can refund user's devices.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function refund(User $user, Device $device) {
        if (auth()->user()->id === $device->user_id) return true; 
    }

    /**
     * Only admin can view all history
     */
    public function viewAllHistory(User $user, Device $device) {
        
    }
}
