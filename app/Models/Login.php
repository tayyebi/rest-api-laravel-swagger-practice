<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Login",
 *     description="Login Model",
 *     @OA\Xml(
 *         name="Login"
 *     )
 * )
 */
class Login extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'password', 'generate_new_api_key'];


     /** 
     * @OA\Property(
     *     title="Phone",
     *     description="Login of the user",
     *     format="string",
     *     example="+989388063251"
     * )
     *
     * @var string
     */
    private $phone;

    /** 
     * @OA\Property(
     *     title="Password",
     *     description="Secret passphrase of the user",
     *     format="string",
     *     example="***"
     * )
     *
     * @var string
     */
    private $password;

    /** 
     * @OA\Property(
     *     title="Generate new API key",
     *     description="To allow API to generate a new session",
     *     format="boolean",
     *     example=false
     * )
     *
     * @var boolean
     */
    private $generate_new_api_key;
}
