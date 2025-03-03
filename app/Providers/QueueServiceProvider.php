<?php

namespace App\Providers;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Log any failed jobs with useful debugging details.
        Queue::failing(function (JobFailed $event) {
            Log::error("Job failed: ", [
                'connection' => $event->connectionName,
                'job' => method_exists($event->job, 'getName') ? $event->job->getName() : 'Unknown job',
                'exception'  => $event->exception->getMessage(),
            ]);
        });
    }

}
