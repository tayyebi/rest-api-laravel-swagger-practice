<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Demo API Documentation",
 *      description="Application Programming Interface Of Demo",
 *      @OA\Contact(
 *          email="smile@tyyi.net"
 *      ),
 *      @OA\License(
 *          name="MIT",
 *          url="http://access_is_not_allowed_by_third_party"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Local Machine"
 * )
 * 
 *  * @OA\Server(
 *      url="http://api.demo.com:8000",
 *      description="Demo Api Server"
 * )
 * 
 * @OA\Tag(
 *     name="Users",
 *     description="v1"
 * )
 * 
 * @OA\Tag(
 *     name="Geo",
 *     description="v1"
 * )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
