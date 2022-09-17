<?php
$entity_name_lower = $argv[1];
$entity_name_upper = $argv[2];
$entity_name_lower_singular = $argv[3];
$entity_name_upper_singular = $argv[4];

$file_rest = <<<EOF
GET http://127.0.0.1:8000/api/v1/$entity_name_lower

################

GET http://127.0.0.1:8000/api/v1/$entity_name_lower/abce1234-1234-4321-1324-abcde1234567

################

POST  http://127.0.0.1:8000/api/v1/$entity_name_lower
content-type: application/json

{
    "id": "abce1234-1234-4321-1324-abcde1234568",
}

################

PUT  http://127.0.0.1:8000/api/v1/$entity_name_lower/abce1234-1234-4321-1324-abcde1234567
content-type: application/json

{
    "id": "abce1234-1234-4321-1324-abcde1234567",
}

################

DELETE  http://127.0.0.1:8000/api/v1/$entity_name_lower/abce1234-1234-4321-1324-abcde1234567

EOF;

$file_controller = <<< EOF
<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\\${entity_name_upper_singular}PostRequest;
use App\Http\Requests\\${entity_name_upper_singular}UpdateRequest;
use App\Http\Resources\\${entity_name_upper_singular}Resource;
use App\Models\\$entity_name_upper_singular;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

class ${entity_name_upper}Controller extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/$entity_name_lower",
     *      operationId="get$entity_name_upper",
     *      tags={"$entity_name_upper"},
     *      summary="Get list of $entity_name_lower",
     *      description="Returns list of $entity_name_lower",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/$entity_name_upper_singular")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *        response=422,
     *        description="Unprocessable Content",
     *      )
     *     )
     */
    public function index()
    {
        // abort_if(Gate::denies('$entity_name_lower_singular\_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new $entity_name_upper_singular\Resource($entity_name_upper_singular::with([])->paginate());
    }

     /**
     * @OA\Post(
     *      path="/api/v1/$entity_name_lower",
     *      operationId="insert$entity_name_upper_singular",
     *      tags={"$entity_name_upper"},
     *      summary="Stores a new $entity_name_lower_singular",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/$entity_name_upper_singular")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/$entity_name_upper_singular")
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
    public function store($entity_name_upper_singular\PostRequest \$request)
    {
        \$$entity_name_lower_singular = $entity_name_upper_singular::create(\$request->all());

        return (new $entity_name_upper_singular\Resource(\$$entity_name_lower_singular))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/$entity_name_lower/{id}",
     *      operationId="get$entity_name_upper_singular",
     *      tags={"$entity_name_upper"},
     *      summary="Returns a single $entity_name_lower_singular",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the $entity_name_lower_singular which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Category")
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
    public function show($entity_name_upper_singular \$$entity_name_lower_singular)
    {
        // abort_if(Gate::denies('$entity_name_lower_singular\_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new $entity_name_upper_singular\Resource(\$$entity_name_lower_singular);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/$entity_name_lower/{id}",
     *      tags={"$entity_name_upper"},
     *      summary="Updates a single $entity_name_lower_singular",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="id",
    *          description="$entity_name_upper_singular's id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/$entity_name_upper_singular")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/$entity_name_upper_singular")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update($entity_name_upper_singular\UpdateRequest \$request, string \$id)
    {
        \$$entity_name_lower_singular = $entity_name_upper_singular::findOrFail(\$id);
        \$${entity_name_lower_singular}->update(\$request->all());

        return (new ${entity_name_upper_singular}Resource(\$$entity_name_lower_singular))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/$entity_name_lower/{id}",
     *      operationId="delete$entity_name_upper_singular",
     *      tags={"$entity_name_upper"},
     *      summary="Delete Existing $entity_name_upper_singular",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="$entity_name_upper_singular's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy($entity_name_upper_singular \$$entity_name_lower_singular)
    {
        // abort_if(Gate::denies('$entity_name_lower_singular\_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        \$${entity_name_lower_singular}->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}


EOF;


$file_update_request = <<< EOF
<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class ${entity_name_upper_singular}UpdateRequest extends FormRequest
{

    public function authorize()
    {
        // abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    public function rules()
    {
        
        return [
            'title' => [
                'required',
            ],
        ];
    }
}

?>

EOF;

$file_post_request = <<< EOF
<?php
namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class ${entity_name_upper_singular}PostRequest extends FormRequest
{

    public function authorize()
    {
        // abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    public function rules()
    {
        
        return [
            'title' => [
                'required',
            ],
        ];
    }
}

?>

EOF;


$file_resource = <<<EOF
<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ${entity_name_upper_singular}Resource extends JsonResource
{
    public function toArray(\$request)
    {
        return parent::toArray(\$request); 
    }
}

?>

EOF;

$file_model = <<< EOF
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     title="$entity_name_upper_singular",
 *     description="$entity_name_upper_singular Model",
 *     @OA\Xml(
 *         name="$entity_name_upper_singular"
 *     )
 * )
 */
class $entity_name_upper_singular extends Model
{
    use HasFactory;
    protected \$fillable = ['id', 'title'];


     /** 
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="string",
     *     example=1
     * )
     *
     * @var string
     */
    private \$id;

    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the new $entity_name_lower_singular",
     *      example="Kavir 165/18/24"
     * )
     *
     * @var string
     */
    public \$title;

}


EOF;

$file_controller = str_replace($entity_name_upper_singular.'\\', $entity_name_upper_singular, $file_controller);

file_put_contents("REST/$entity_name_lower.http", $file_rest);
file_put_contents("app/Http/Controllers/V1/${entity_name_upper}Controller.php", $file_controller);
file_put_contents("app/Http/Requests/${entity_name_upper_singular}UpdateRequest.php", $file_update_request);
file_put_contents("app/Http/Requests/${entity_name_upper_singular}PostRequest.php", $file_post_request);
file_put_contents("app/Models/$entity_name_upper_singular.php", $file_model);
file_put_contents("app/Http/Resources/${entity_name_upper_singular}Resource.php", $file_resource);
?>