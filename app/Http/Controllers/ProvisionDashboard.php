<?php

namespace App\Http\Controllers;

use App\Models\AppConst;
use Illuminate\Http\Request;

class ProvisionDashboard extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        return ($user->role->name === AppConst::SUPPERVISOR) ? view('dashboard')->with('user', $user) : view('profile')->with('user', $user);
    }
}
