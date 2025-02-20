<?php

namespace App\Formatters;

class ResponseFormatter
{
    public static function format(string $message = '', int $statusCode = 200): array
    {
        return [
            'status'    => $statusCode === 200 ? 'success' : 'error',
            'message'   => $message,
            'timestamp' => now()->toDateTimeString(),
        ];
    }
}