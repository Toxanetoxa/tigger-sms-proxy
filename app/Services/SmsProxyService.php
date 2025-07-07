<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class SmsProxyService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.sms_api.url');
//        $this->token = config('services.sms_api.token');
    }

    /**
     * @throws Exception
     */
    protected function request(string $action, array $params = []): array
    {
        $query = array_merge([
            'action' => $action,
            'token' => $params['token'],
        ], $params);

        $response = Http::get($this->baseUrl, $query);

        if ($response->failed()) {
            throw new Exception('External API error');
        }

        $data = $response->json();

        if (($data['code'] ?? 'error') !== 'ok') {
            throw new Exception($data['message'] ?? 'Unknown API error');
        }

        return $data;
    }

    /**
     * @throws Exception
     */
    public function getNumber(string $token, string $action, string $country, string $service, ?int $rentTime = null): array
    {
        $params = [
            'country' => $country,
            'service' => $service,
            'token' => $token,
        ];

        if ($rentTime !== null) {
            $params['rent_time'] = $rentTime;
        }

        return $this->request($action, $params);
    }

    /**
     * @throws Exception
     */
    public function getSms(string $token, string $action, string $activation): array
    {
        $params = [
            'activation' => $activation,
            'token' => $token,
        ];

        return $this->request($action, $params);
    }

    /**
     * @throws Exception
     */
    public function cancelNumber(string $token, string $action, string $activation): array
    {
        $params = [
            'activation' => $activation,
            'token' => $token,
        ];
        return $this->request($action, $params);
    }

    /**
     * @throws Exception
     */
    public function getStatus(string $token, string $action, string $activation): array
    {
        $params = [
            'activation' => $activation,
            'token' => $token,
        ];
        return $this->request($action, $params);
    }

}
