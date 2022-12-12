<?php
/**
 * Author: Theo Champion
 * Date: 09/12/2022
 * Time: 10:46
 */


namespace LesIgnobles\BaseApiLaravel\Http\Controllers;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class BaseApiController
{
    public function successResponse(
        mixed $data = true,
        callable $transformMethod = null,
        int $httpStatus = 200,
        array $headers = []
    ): JsonResponse
    {
        if ($data instanceof LengthAwarePaginator) {

            return new JsonResponse([
                'result'         => 'success',
                'data'           => is_callable($transformMethod) ? $this->_transformDataForResponse($data->items(), $transformMethod) : $data->items(),
                'total'          => $data->total(),
                'pages'          => $data->lastPage(),
                'items_per_page' => $data->perPage(),
                'page'           => $data->currentPage()
            ]);
        } else {
            return new JsonResponse([
                'result' => 'success',
                'data'   => is_callable($transformMethod) ? $this->_transformDataForResponse($data, $transformMethod) : $data
            ], $httpStatus, $headers);
        }

    }

    private function _transformDataForResponse(mixed $data, callable $transformedMethod): mixed
    {
        if ($data instanceof Collection) {
            return is_callable($transformedMethod) ? $data->map($transformedMethod) : $data->all();
        }

        return is_callable($transformedMethod) ? array_map($transformedMethod, $data) : $data;
    }
}
