<?php

namespace App\Observers;

use App\Events\ExceptionFired;
use App\Models\Exception;

class ExceptionsObserver
{
    /**
     * Handle the Exception "created" event.
     *
     * @param  \App\Models\Exception  $exception
     * @return void
     */
    public function created(Exception $exception)
    {   //Send Pusher Notification with Exception 
        event(new ExceptionFired($exception));
    }

    /**
     * Handle the Exception "updated" event.
     *
     * @param  \App\Models\Exception  $exception
     * @return void
     */
    public function updated(Exception $exception)
    {
        //
    }

    /**
     * Handle the Exception "deleted" event.
     *
     * @param  \App\Models\Exception  $exception
     * @return void
     */
    public function deleted(Exception $exception)
    {
        //
    }

    /**
     * Handle the Exception "restored" event.
     *
     * @param  \App\Models\Exception  $exception
     * @return void
     */
    public function restored(Exception $exception)
    {
        //
    }

    /**
     * Handle the Exception "force deleted" event.
     *
     * @param  \App\Models\Exception  $exception
     * @return void
     */
    public function forceDeleted(Exception $exception)
    {
        //
    }
}
