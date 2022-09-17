<?php
namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="UserPromoteToMemberRequest",
 *     description="Promote To Member Model",
 *     @OA\Xml(
 *         name="UserPromoteToMemberRequest"
 *     )
 * )
 */
class UserPromoteToMemberRequest extends FormRequest
{

    public function authorize()
    {
        // abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    public function rules()
    {
        
        return [
            'id' => [
                'required',
            ],

        ];
    }

    
    /**
     * @OA\Property(
     *      title="User Id",
     *      description="Id of the user",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *      title="City Id",
     *      description="Id of the city",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $city_id;
}

?>
