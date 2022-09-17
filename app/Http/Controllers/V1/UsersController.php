<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserPromoteToMemberRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\MemberResource;
use App\Http\Resources\PersonResource;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\UserResource;
use App\Models\LoginResult;
use App\Models\Member;
use App\Models\Person;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/v1/login",
     *      operationId="Login",
     *      tags={"Users"},
     *      summary="Creates a new API key for the user",
     *      description="It will generate a new token for their login.",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Login")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LoginResult")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function login(UserLoginRequest $request)
    {
        // Login
        $login = User::findOrFail($request->phone);
        $login->type = 'administrator'; // todo: dynamically set this variable
        if (!$login)
            abort(403, 'Invalid login');
        $success = Hash::check($request->password, $login['password']);

        // Initiate result
        $loginResult = new LoginResult();
        $loginResult->phone = $request->phone;
        $loginResult->success = $success;
        
        // Generate token
        $token = $request->generate_new_api_key ? Str::random(32) : false;

        if ($success)
        {
            // Check token updated
            if ($token)
            {
                // Update Token in Database
                $login->update([
                    'api_token' => $token
                ]);

                // Set token in response
                $loginResult->api_key = $token;
            }
            
            // Set auth user
            Auth::setUser($login);
        }

        // Return response
        return $loginResult;
    }

     /**
     * @OA\Post(
     *      path="/api/v1/register",
     *      operationId="Register",
     *      tags={"Users"},
     *      summary="Stores a new user",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/User")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function store(UserRegisterRequest $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->all());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}

