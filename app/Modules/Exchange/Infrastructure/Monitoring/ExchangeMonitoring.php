<?php

namespace App\Modules\Exchange\Infrastructure\Monitoring;

use Illuminate\Support\Facades\Log;

class ExchangeMonitoring
{
    /**
     * Measures and logs the API response time.
     *
     * @param callable $callback
     * @return mixed
     */
    public function monitorResponseTime(callable $callback)
    {
        $startTime = microtime(true);
        try {
            $result = $callback();
        } catch (\Exception $exc) {
            Log::error("Exchange API error: " . $exc->getMessage());
            throw $exc;
        }
        $responseTime = microtime(true) - $startTime;
        Log::info("Exchange API response time: {$responseTime} seconds");
        return $result;
    }
}
