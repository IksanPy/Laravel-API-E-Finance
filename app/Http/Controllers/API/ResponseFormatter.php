<?php

namespace App\Http\Controllers\API;

class ResponseFormatter
{
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null
        ],
        'data' => null
    ];

    public static function success($message = null, $data = null, $code = 200, $filter = false)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;
        if ($filter) {
            self::$response['filter'] = $filter;
        }

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function error($message = null, $data = null, $code = 400)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
