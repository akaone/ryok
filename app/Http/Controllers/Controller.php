<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *     title="Ryok api",
 *     version="0.0.1",
 *     termsOfService="https://ryok.dev/terms/",
 *     @OA\Contact(
 *         email="support@ryok.com"
 *     )
 * ),
 *
 * @OA\PathItem(path="ryok"),
 *
 *
 * @OA\Server(
 *     description="api documentation server",
 *     url=L5_SWAGGER_CONST_HOST
 * ),
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
