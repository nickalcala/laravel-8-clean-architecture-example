<?php

namespace Service\Common;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class PostController
 * @package Service\Post
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0",
 *         title="Laravel 8 Clean Architecture",
 *         @OA\License(name="MIT")
 *     ),
 *     @OA\Server(
 *         description="API server",
 *         url="http://localhost/api"
 *     )
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     in="header",
 *     name="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * ),
 */
abstract class Controller extends BaseController
{
    use Helpers, AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
