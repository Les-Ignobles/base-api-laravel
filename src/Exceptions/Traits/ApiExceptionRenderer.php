<?php
/**
 * Author: Theo Champion
 * Date: 12/12/2022
 * Time: 12:03
 */


namespace LesIgnobles\BaseApiLaravel\Exceptions\Traits;


use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use LesIgnobles\BaseApiLaravel\Exceptions\Adapters\AuthenticationExceptionAdapter;
use LesIgnobles\BaseApiLaravel\Exceptions\Adapters\HttpExceptionAdapter;
use LesIgnobles\BaseApiLaravel\Exceptions\Adapters\NotFoundHttpExceptionAdapter;
use LesIgnobles\BaseApiLaravel\Exceptions\Adapters\ValidationExceptionAdapter;
use LesIgnobles\BaseApiLaravel\Exceptions\ApiException;
use LesIgnobles\BaseApiLaravel\Exceptions\ExceptionNormalizer;
use LesIgnobles\BaseApiLaravel\Exceptions\UnexpectedException;
use LesIgnobles\BaseApiLaravel\Http\Requests\BaseApiRequest;
use LesIgnobles\BaseApiLaravel\PackageServiceProvider;
use LesIgnobles\BaseApiLaravel\Utils\Context;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

trait ApiExceptionRenderer
{
    public function renderApiException(Throwable $e): JsonResponse
    {
        /** @var BaseApiRequest $request */
        $request = resolve(BaseApiRequest::class);

        if (!$e instanceof ApiException) {
            $e = $this->convertForeignExceptions($e);
        }

        $logEnable = config(PackageServiceProvider::BASE_API_CONFIG_NAME . '.exception.log_enable', false);

        if ($logEnable) {
            $channel = $e->getLevel() === ApiException::COMMON
                ? $this->getCommonErrorLogChannel()
                : $this->getCriticalErrorLogChannel();

            $currentUser = $request->user();
            Log::channel($channel)->error($e->getMessage(), [
                'Url'       => $request->fullUrl(),
                'User'      => isset($currentUser) ? $currentUser->id : null,
                'HTTP Verb' => $request->method(),
                'Request'   => $this->parseRequest($request),
                'Headers'   => $this->parseRequestHeaders($request),
                'Exception' => ExceptionNormalizer::devNormalize($e, false)
            ]);
        }

        return new JsonResponse([
            'result' => 'error',
            'error'  => Context::isInLocal() ? ExceptionNormalizer::devNormalize($e) : ExceptionNormalizer::prodNormalize($e)
        ], $e->getHttpCode());
    }

    private function convertForeignExceptions(Throwable $e): ApiException
    {
        return match (true) {
            $e instanceof ValidationException => new ValidationExceptionAdapter($e),
            $e instanceof NotFoundHttpException => new NotFoundHttpExceptionAdapter($e),
            $e instanceof HttpException => new HttpExceptionAdapter($e),
            $e instanceof AuthenticationException => new AuthenticationExceptionAdapter($e),
            default => new UnexpectedException($e)
        };
    }

    private function parseRequestHeaders(BaseApiRequest $request): array
    {
        $headers = $request->headers->all();

        if (isset($headers['authorization'])) {
            $headers['authorization'] = 'Bearer *****';
        }

        return $headers;
    }

    private function parseRequest(BaseApiRequest $request): array
    {
        $blacklist = config(PackageServiceProvider::BASE_API_CONFIG_NAME . '.exception.blacklist_request_parsing', []);

        $data = $request->toArray();
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $blacklist)) {
                $data[$key] = $blacklist[$key];
            }
        }

        return $data;
    }

    private function getCommonErrorLogChannel(): string
    {
        return config(PackageServiceProvider::BASE_API_CONFIG_NAME . '.exception.common_error_log_channel', 'null');
    }

    private function getCriticalErrorLogChannel()
    {
        return config(PackageServiceProvider::BASE_API_CONFIG_NAME . '.exception.critical_error_log_channel', 'null');
    }
}
