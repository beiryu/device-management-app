<?php

namespace App\Http\Controllers;

use App\Events\UserContacted;
use App\Http\Requests\MailRequest;
use App\Models\User;

class ContactController extends Controller
{
    public function index () {
        return view('contact');
    }

    /**
     * send email
     */
    public function store(MailRequest $request) {
        UserContacted::dispatch($request);
        return redirect(route('contact.index'))->with('status', __('mail.send.success'));
    }
}
