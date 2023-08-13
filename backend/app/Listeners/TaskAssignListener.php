<?php

namespace App\Listeners;

use App\Notifications\TaskAssignNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaskAssignListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        auth()->user()->notify(new TaskAssignNotification($event->data));
    }
}
