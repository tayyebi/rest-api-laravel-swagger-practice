<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User Model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'phone';
    public $incrementing = false;
    public function getKeyName(){
        return 'phone';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'remember_token',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** 
     * @OA\Property(
     *     title="Phone",
     *     description="Phone number of user",
     *     format="string",
     *     example="+989388063351"
     * )
     *
     * @var string
     */
    public $phone;

    /** 
     * @OA\Property(
     *     title="Name",
     *     description="Fullname of the user",
     *     format="string",
     *     example="Mohammad R. Tayyebi"
     * )
     *
     * @var string
     */
    public $name;

    /** 
     * @OA\Property(
     *     title="Password",
     *     description="Secret Passkey",
     *     format="string",
     *     example="3Xample123!@#"
     * )
     *
     * @var string
     */
    public $password;

    /** 
     * @OA\Property(
     *     title="API Token",
     *     description="Secret random key",
     *     format="string",
     *     example="aabbcc112233"
     * )
     *
     * @var string
     */
    public $api_token;

    /**
     * @OA\Property(
     *     title="Type",
     *     description="User type which defines permissions",
     *     format="string",
     *     example="administrator"
     * )
     *
     * @var string
     */
    public $type;
}
