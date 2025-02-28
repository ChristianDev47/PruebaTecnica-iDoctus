<?php

namespace Tests\Integration\ExternalServices\Redis;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Redis;

class RedisConnectionTest extends TestCase
{
    public function testRedisConnection()
    {
        $connection = Redis::connection();
        $this->assertNotNull($connection);
        $this->assertTrue($connection->ping() === 'PONG');
    }
}
