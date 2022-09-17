<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Login Result",
 *     description="Login Result Model",
 *     @OA\Xml(
 *         name="LoginResult"
 *     )
 * )
 */
class LoginResult extends Model
{
    use HasFactory;
    protected $fillable = ['phone', 'api_key', 'success', 'type'];


     /** 
     * @OA\Property(
     *     title="Phone",
     *     description="Login of the user",
     *     format="string",
     *     example="guest"
     * )
     *
     * @var string
     */
    private $phone;

    /** 
     * @OA\Property(
     *     title="API Key",
     *     description="Bearer Token Generated for Authorization",
     *     format="string",
     *     example="qwertyuioplkjhgfdsazxcvbnm123456"
     * )
     *
     * @var string
     */
    private $api_key;

    /** 
     * @OA\Property(
     *     title="Success",
     *     description="Was login successful",
     *     format="boolean",
     *     example=false
     * )
     *
     * @var boolean
     */
    private $success;

    /** 
     * @OA\Property(
     *     title="Type",
     *     description="The user type",
     *     format="string",
     *     example="administrator"
     * )
     *
     * @var string
     */
    private $type;
}
