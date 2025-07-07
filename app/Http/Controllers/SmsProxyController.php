<?php

namespace App\Http\Controllers;

use App\Services\SmsProxyService;
use Exception;
use Illuminate\Http\Request;

class SmsProxyController extends Controller
{
    /**
     * @throws Exception
     */
    public function getNumber(Request $request, SmsProxyService $smsProxy): \Illuminate\Http\JsonResponse
    {
        $country = $request->query('country');
        $service = $request->query('service');
        $rentTime = $request->query('rent_time');

        if (!$country || !$service) {
            return response()->json([
                'code' => 'error',
                'message' => 'Missing required parameters: country or service',
            ], 400);
        }

        $data = $smsProxy->getNumber($country, $service, $rentTime);

        return response()->json($data);
    }

    /**
     * @throws Exception
     */
    public function getSms(
        Request $request,
        SmsProxyService $smsProxy
    ): \Illuminate\Http\JsonResponse {
        $activation = $request->query('activation');

        if (!$activation) {
            return response()->json([
                'code' => 'error',
                'message' => 'Missing required parameter: activation',
            ], 400);
        }

        $data = $smsProxy->getSms($activation);

        return response()->json($data);
    }

    /**
     * @throws Exception
     */
    public function cancelNumber(
        Request $request,
        SmsProxyService $smsProxy
    ): \Illuminate\Http\JsonResponse {
        $activation = $request->query('activation');

        if (!$activation) {
            return response()->json([
                'code' => 'error',
                'message' => 'Missing required parameter: activation',
            ], 400);
        }

        $data = $smsProxy->cancelNumber($activation);

        return response()->json($data);
    }

    /**
     * @throws Exception
     */
    public function getStatus(
        Request $request,
        SmsProxyService $smsProxy
    ): \Illuminate\Http\JsonResponse {
        $activation = $request->query('activation');

        if (!$activation) {
            return response()->json([
                'code' => 'error',
                'message' => 'Missing required parameter: activation',
            ], 400);
        }

        $data = $smsProxy->cancelNumber($activation);

        return response()->json($data);
    }
}
