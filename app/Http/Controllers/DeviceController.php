<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Device;
use App\Models\Type;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDeviceRequest;
use App\Models\AppConst;
use App\Services\DeviceService;

class DeviceController extends Controller
{
    protected $deviceSer;
 
    public function __construct(DeviceService $deviceSer) 
    {
        $this->deviceSer = $deviceSer;
        $this->authorizeResource(Device::class, 'device', [
            'except' => [ 'index', 'show' ],
        ]);
    }

    /**
     * Display a listing of the devices and types of it.
     */
    public function index (Request $request) {
        return view('devices.device', [
            'devices' => $this->deviceSer->searchDevices($request), 
            'types' => $this->deviceSer->getAll(new Type()),        
        ]);
        
    }
    
    /**
     * Show the form for creating a new device.
     */
    public function create() {
        return view('devices.create-device', [
            'types' => $this->deviceSer->getAll(new Type()),
        ]);
    }

    /**
     * Store a newly created device in storage.
     */
    public function store(StoreDeviceRequest $request) {
        $this->deviceSer->save($request);
        return redirect()->back()->with('status', __('device.store'));   
    }

    /**
     * Display the specified device and the related devices.
     */
    public function show(Device $device) {

        return view('devices.single-device', [
            'device' => $device, 
            'relatedDevices' => $this->deviceSer->relatedDevices($device),
        ]);
    }

    /**
     * Show the form for creating a new device.
     */
    public function showAll() {
        return view('devices.all-devices', [
            'devices' => $this->deviceSer->getAll(new Device(), true)->paginate(AppConst::DEVICE_PER_ADMIN_PAGE),
        ]);
    }

    /**
     * Display the user's devices.
     */
    public function myDevices() {
        return view('devices.my-devices', [
            'devices' => $this->deviceSer->myDevices()
        ]);
    }

    /**
     * Hire the specified device.
     */
    public function hire(Device $device) {
        $this->deviceSer->hireDevice($device);
        return redirect('/')->with('status', __('device.hire'));
    }

    /**
     * Display the pending devices, only suppervisor's session.
     */
    public function pending() {
        $this->authorize('pending', Device::class);
        return view('devices.pending-device', [
            'pendingDevices' => $this->deviceSer->pendingDevices()
        ]);
    }

    public function tracking() {
        $this->authorize('tracking', Device::class);
        return view('devices.tracking-device', [
            'trackingDevices' => $this->deviceSer->trackingDevices()
        ]);
    }

    /**
     * Approve the specified device by suppervisor.
     */
    public function approve(Device $device) {
        $this->authorize('approve', Device::class);
        $this->deviceSer->approveDevice($device);
        return redirect()->back()->with('status', __('device.approve'));
    }

    /**
     * Return or cancel the specified device.
     */
    public function refund(User $user, Device $device)
    {
        $this->authorize('refund', $device);
        $this->deviceSer->refundDevice($device); 
        return redirect()->back()->with('status', __('device.refund'));
    }

    /**
     * Show the form for editing the device.
     */
    public function edit(Device $device) {
        return view('devices.edit-device', [
            'device' => $device,
            'types' => $this->deviceSer->getAll(new Type()),
        ]);
    }

    /**
     * Update the device in storage.
     */
    public function update(StoreDeviceRequest $request, Device $device) {
        $this->deviceSer->save($request, $device);
        return redirect()->back()->with('status', __('device.edit'));
    }

    /**
     * Remove the device from storage.
     */
    public function destroy(Request $request, Device $device) {
        $device->delete();
        return $this->deviceSer->getRedirectDestroy()->with('status', __('device.delete'));
    }

    /**
     * View history
     */
    public function history(Request $request, Device $device) {
        return view('devices.history', [
            'data' => $this->deviceSer->getHistoryData($request, $device),
        ]);
    }

    /**
     * support live search tool
     */
    public function liveSearch(Request $request) {
        return response()->json($this->deviceSer->searchDevices($request));
    }
}