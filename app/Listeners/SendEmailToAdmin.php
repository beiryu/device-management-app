<?php

namespace App\Listeners;

use App\Jobs\SendContactEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Contact;
use App\Models\AppConst;
use Illuminate\Support\Facades\Mail;
class SendEmailToAdmin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        SendContactEmailJob::dispatch($event->request->only('name', 'email', 'subject', 'message'));
    }
}
