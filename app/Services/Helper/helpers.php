<?php
namespace App\Services\HelperService;

use Illuminate\Http\JsonResponse;

function responseFailed(string $message=null, int $code=400):JsonResponse
{
//    dd(1);
    return response()->json([
        'message' => $message ?? __('Bad Request')
    ], $code);
}
