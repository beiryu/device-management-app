<?php
namespace App\Services;

use App\Exceptions\SaveDeviceException;
use App\Exceptions\SearchDeviceException;
use App\Models\AppConst;
use App\Models\Device;
use App\Models\Status;
use App\Models\Type;
use App\Models\User;

use App\Repositories\Repository;
use App\Repositories\DeviceRepository;
use App\Repositories\StatusRepository;
use App\Repositories\UserRepository;

use Illuminate\Support\Str;

class DeviceService {
    
    use Repository, DeviceRepository, StatusRepository, UserRepository;

    /**
     * Searching devices by name
     */
    public function searchByName($request) {
        return $this->where(new Device(), ['name' => '%'.$request->search.'%'], 'like')->latest();
    }

    /** 
     * Searching devices by type
     */
    public function searchByType($request) {
        return $this->where(new Type(), ['name' => $request->type])->firstOrFail()->devices();
    }

    /**
     * Searching all devies 
     */
    public function searchAll() {
        return $this->getAll(Device::class, true);
    }

    /**
     * Searching devices logic
     */
    public function searchDevices($request) {
        try {
            $statusId = $this->getIdStatus(Status::OPEN);
            if ($request->search) {
                $query = $this->searchByName($request);
            }
            elseif ($request->type) {
                $query = $this->searchByType($request);
            } else {
                $query = $this->searchAll();
            }
            $devices = $this->where($query, ['status_id' => $statusId])->paginate(AppConst::DEVICE_PER_PAGE);            
        } catch (SearchDeviceException $exception) {
            throw $exception;
        }
        return $devices;
    }

    /**
     * Store devie in the storage, wheather this device is null. Otherwise this device is updated.
     */
    public function save($request, $device=null) {
        try {
            $request->merge([
                'imgPath' => $this->generateImgPath($request), 
                'status_id' => $this->getIdStatus(Status::OPEN),
                'slug' => $this->generateSlug($request->name),
            ]);
        } catch (SaveDeviceException $exception) {
            throw $exception;
        }
        
        ($device) ? $device->update($request->all()) : $this->saveToStore(new Device(), $request->all());
    }

    /**
     * Generate the image path from the request.
     */
    public function generateImgPath($request) {
        $path = 'storage/' . $request->file('image')->store('deviceImgs', 'public');
        if (!$path) throw new SaveDeviceException();
        return $path;
    }

    /**
     * Generate the slug from name.
     */
    public function generateSlug($name) {
        $device = $this->getAll(new Device(), true)->first();
        $deviceId = ($device) ? $device->id + 1 : 1;
        $slug = Str::slug($name, '-') . '-' . $deviceId; 
        if (!$slug) throw new SaveDeviceException();
        return $slug;
    }

    /**
     * Display my devices
     */
    public function myDevices() {
        $status_id = $this->getIdStatus(Status::LENT);
        $user_id = $this->getUserId();
        $devices = $this->where(new Device(), [
            'user_id' => $user_id,
            'status_id' => $status_id,    
        ])->get();
        return $devices;
    }

    /**
     * Hire specified device
     */
    public function hireDevice($device) {
        $collection = [
            'user_id' => $this->getUserId(), 
            'status_id' => $this->getIdStatus(Status::PENDING)
        ];
        $device->update($collection);
    }

    /**
     * Display the pending devices in admin screen
     */
    public function pendingDevices() {
        $status_id = $this->getIdStatus(Status::PENDING);
        return $this->where(new Device(), ['status_id' => $status_id])->get();
    }

    /**
     * Display the tracking devices in admin screen
     */
    public function trackingDevices() {
        $status_id = $this->getIdStatus(Status::LENT);
        return $this->where(new Device(), ['status_id' => $status_id])->get();
    }

    /**
     * Acction approve specified device
     */
    public function approveDevice($device) {
        $collection = [
            'status_id' => $this->getIdStatus(Status::LENT)
        ];
        $device->update($collection);
        $device->users()->attach($device->user);
    }

    /**
     * Cancel or Return this device to the store.
     */
    public function refundDevice($device) {
        $collection = [
            'user_id' => null,   
            'status_id' => $this->getIdStatus(Status::OPEN)
        ];       
        $device->update($collection);
    }

    /**
     * get history data 
     * if It's admin's session -> view all
     * otherwise The user can see user's own hired devices.
     */
    public function getHistoryData($request, $device) {
        $data = array();
        if ($request->user()->can('viewAllHistory', $device)) {
            $users = $this->getUserHired();   
            foreach ($users as $user) {
                $userDevices = $this->getDevicesOfUser($user->user_id);
                $data[] = $userDevices;
            }         
        } else {
            $data[] = $this->getDevicesOfUser($this->getUserId());
        }
        return $data;
    }

    /**
     * after destroy 
     */
    public function getRedirectDestroy() {
        return (redirect()->back()->getTargetUrl() == route('device.all-devices')) ? redirect()->back() : redirect('/');
    }
}