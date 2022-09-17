<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     title="Province",
 *     description="Province Model",
 *     @OA\Xml(
 *         name="Province"
 *     )
 * )
 */
class Province extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'code', 'slug'];


     /** 
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="integer",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

         /** 
     * @OA\Property(
     *     title="slug",
     *     description="slug",
     *     format="string",
     *     example="aze"
     * )
     *
     * @var string
     */
    private $slug;

         /** 
     * @OA\Property(
     *     title="code",
     *     description="code",
     *     format="string",
     *     example="041"
     * )
     *
     * @var string
     */
    private $code;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the state",
     *      example="همدان"
     * )
     *
     * @var string
     */
    public $name;

}

