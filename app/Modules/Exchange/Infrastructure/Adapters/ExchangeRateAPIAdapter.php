<?php

namespace App\Modules\Exchange\Infrastructure\Adapters;

use GuzzleHttp\Client;
use Exception;

class ExchangeRateAPIAdapter
{
    private Client $httpClient;
    private string $apiUrl;
    private string $apiKey;
    private string $from;
    private string $to;

    public function __construct()
    {
        $this->httpClient = new Client(['timeout' => 5]);

        $this->apiUrl = config('services.exchange_rate.api_url');
        $this->apiKey = config('services.exchange_rate.api_key');
        $this->from = config('services.exchange_rate.from');
        $this->to = config('services.exchange_rate.to');
    }

    /**
     * Fetching the exchange rate from the external API.
     *
     * @return float
     * @throws Exception
     */
    public function fetchRate(): float
    {
        $url = "{$this->apiUrl}/v1/live/?api_key={$this->apiKey}&base={$this->from}";
        try {
            $response = $this->httpClient->get($url);

            if ($response->getStatusCode() !== 200) {
                throw new Exception("Error connecting to the external API");
            }

            $data = json_decode($response->getBody()->getContents(), true);

            if (!isset($data['exchange_rates'][$this->to])) {
                throw new Exception("API response does not contain the target rate");
            }

            return (float) $data['exchange_rates'][$this->to];
        } catch (Exception $exc) {
            throw new Exception("Failed to fetch exchange rate: " . $exc->getMessage());
        }
    }
}
