<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     title="City",
 *     description="City Model",
 *     @OA\Xml(
 *         name="City"
 *     )
 * )
 */
class City extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'province_id', 'latitude', 'longitude', 'phi', 'lambda'];


     /** 
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="string",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new city",
     *      example="همدان"
     * )
     *
     * @var string
     */
    public $name;

    /** 
     * @OA\Property(
     *     title="Province ID",
     *     description="ID of the province containing this city",
     *     format="string",
     *     example=1
     * )
     *
     * @var integer
     */
    private $province_id;

    /**
     * @OA\Property(
     *      title="Latitude",
     *      description="Geographical latitude of this city",
     *      example="37° 55’ 4.008’’ N"
     * )
     *
     * @var string
     */
    public $latitude;
    
    /**
     * @OA\Property(
     *      title="Longitude",
     *      description="Geographical longitude of this city",
     *      example="46° 7’ 28.085’’ E"
     * )
     *
     * @var string
     */
    public $longitude;

    /**
     * @OA\Property(
     *      title="Phi",
     *      description="Geographical φ(d) of this city",
     *      example="37.917781829834"
     * )
     *
     * @var string
     */
    public $phi;
    
    /**
     * @OA\Property(
     *      title="Lambda",
     *      description="Geographical  λ(d) of this city",
     *      example="46.1244697570801"
     * )
     *
     * @var string
     */
    public $lambda;

}