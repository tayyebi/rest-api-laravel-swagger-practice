<?php
namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema(
 *     title="UserPromoteFromMemberToProviderRequest",
 *     description="Promote From Member To Provider Model",
 *     @OA\Xml(
 *         name="UserPromoteFromMemberToProviderRequest"
 *     )
 * )
 */
class UserPromoteFromMemberToProviderRequest extends FormRequest
{

    public function authorize()
    {
        // abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    public function rules()
    {
        
        return [
            
            'email' => [
                'requried|email'
            ]
        ];
    }

    
    /**
     * @OA\Property(
     *      title="Member's User Id",
     *      description="Id of the member",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *      title="National Code",
     *      description="National code of the individual",
     *      example="3860000000"
     * )
     *
     * @var string
     */
    public $nationalcode;

    /**
     * @OA\Property(
     *      title="E-Mail",
     *      description="Email of the individual",
     *      example="smile@tyyi.net"
     * )
     *
     * @var string
     */
    public $email;


    /**
     * @OA\Property(
     *      title="Father's Name",
     *      description="Father's name of the individual",
     *      example="Mohammad"
     * )
     *
     * @var string
     */
    public $fathername;
}

?>
