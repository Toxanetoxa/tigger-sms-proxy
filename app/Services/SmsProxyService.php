<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class SmsProxyService
{
    protected string $baseUrl;
    protected string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.sms_api.url');
        $this->token = config('services.sms_api.token');
    }

    /**
     * @throws Exception
     */
    protected function request(string $action, array $params = []): array
    {
        $query = array_merge([
            'action' => $action,
            'token' => $this->token,
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
    public function getNumber(string $country, string $service, ?int $rentTime = null): array
    {
//        $params = [
//            'country' => $country,
//            'service' => $service,
//        ];
//
//        if ($rentTime !== null) {
//            $params['rent_time'] = $rentTime;
//        }
//
//        $data = $this->request('getNumber', $params);

        // TODO удалить тестовые данные
        return [
            'code' => 'ok',
            'number' => '18181818181',
            'activation' => '123456',
            'cost' => 0.01,
//            'data' => $data,
        ];
    }

    /**
     * @throws Exception
     */
    public function getSms(string $activation): array
    {
//        $data = $this->request('getSms', [
//            'activation' => $activation,
//        ]);

        // TODO удалить тестовые данные
        return [
            'code' => 'ok',
            'sms' => '12345',
//            'data' => $data,
        ];
    }

    /**
     * @throws Exception
     */
    public function cancelNumber(string $activation): array
    {
//        $data = $this->request('cancelNumber', [
//            'activation' => $activation,
//        ]);

        // TODO удалить тестовые данные
        return [
            "code" => "ok",
            "activation" => "10869836",
            "status" => "canceled",
//            "data" => $data,
        ];
    }

    /**
     * @throws Exception
     */
    public function getStatus(string $activation): array
    {
//        $data = $this->request('getStatus', [
//            'activation' => $activation,
//        ]);

        // TODO удалить тестовые данные
        return [
            "code" => "ok",
            "status" => "",
            "count_sms" => 4,
            "end_rent_date" => "2022-10-04 13:09:05",
//            "data" => $data,
        ];
    }

}
