<?php
/**
 * Author: Theo Champion
 * Date: 12/12/2022
 * Time: 12:19
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions;


use Illuminate\Support\Arr;

class ExceptionNormalizer
{
    public static function devNormalize(ApiException $e, bool $withTrace = true): array
    {
        $data = [
            'debug_message' => $e->getMessage(),
            'message'       => $e->getFrontMessage(),
            'http_code'     => $e->getHttpCode(),
            'ref'           => $e->getCodeReference(),
            'exception'     => get_class($e),
            'file'          => $e->getFile(),
            'line'          => $e->getLine(),
            'meta_data'     => $e->getMetadata()
        ];
        if ($withTrace) {
            $data['trace'] = collect($e->getTrace())->map(fn($trace) => Arr::except($trace, ['args']))->all();

        }
        return $data;
    }

    public static function prodNormalize(ApiException $e): array
    {
        return [
            'message'   => $e->getFrontMessage(),
            'code'      => $e->getCodeReference(),
            'http_code' => $e->getHttpCode(),
            'meta_data' => $e->getMetadata(),
            'ref'       => $e->getCodeReference()
        ];
    }
}
