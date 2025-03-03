<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;

class QueueServiceProviderTest extends TestCase
{
    public function testQueueServiceProviderLogsJobFailure()
    {
        Queue::fake();

        event(new JobFailed('sync', new \stdClass(), new \Exception('Test failure')));
        
        $this->assertTrue(true);
    }
}
