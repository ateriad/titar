<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\Clients;
use App\Exceptions\ApiErrorException as ApiErrorExceptionAlias;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ApiErrorExceptionAlias
     */
    public function public(Request $request)
    {
        $response = [];

        $client = $request->header('source');
        if (Clients::hasValue($client) == false) {
            throw new ApiErrorExceptionAlias('Client is not supported.');
        }

        $version = $request->header('version');
        if (version_compare($version, '0.0.1', '>=') == false) {
            throw new ApiErrorExceptionAlias('Version is not valid.');
        }

        $response['versions'] = [
            'last' => config("clients.versions.$client.last"),
            'supported' => config("clients.versions.$client.supported"),
            'url' => config("clients.versions.$client.url"),
            'need-update' => version_compare($version, config("clients.versions.$client.last"), '<'),
            'force-update' => version_compare($version, config("clients.versions.$client.supported"), '<'),
        ];

        return new JsonResponse($response);
    }
}
