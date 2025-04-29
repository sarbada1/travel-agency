<?php

namespace App\Traits;


trait MessageReturn
{

    public function success($message, $data = null, $status = 200)
    {
        return [
            'status' => 'success',
            'code' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
    public function error($message, $data = null, $status = 400)
    {
        return [
            'status' => 'error',
            'code' => $status,
            'message' => $message,
            'data' => $data
        ];
    }

    public function warning($message, $data = null, $status = 422)
    {
        return [
            'status' => 'warning',
            'code' => $status,
            'message' => $message,
            'data' => $data
        ];

    }

    public function info($message, $data = null, $status = 200)
    {
        return [
            'status' => 'info',
            'code' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}
