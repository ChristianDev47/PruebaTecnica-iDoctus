<?php

namespace Tests\Integration;

use Exception;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Redis;

class RedisConnectionTest extends TestCase
{
    public function testRedisConnection()
    {
        try {
            $connection = Redis::connection();
            $this->assertNotNull($connection);
            $this->assertEquals('PONG', $connection->ping());
        } catch (Exception $e) {
            $this->fail('Error al conectar con Redis: ' . $e->getMessage());
        }
    }
}
