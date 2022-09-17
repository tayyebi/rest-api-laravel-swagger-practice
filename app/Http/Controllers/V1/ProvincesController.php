<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvincePostRequest;
use App\Http\Requests\ProvinceUpdateRequest;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Illuminate\Support\Facades\Gate as FacadesGate;


class ProvincesController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/provinces",
     *      operationId="getProvinces",
     *      tags={"Geo"},
     *      summary="Get list of provinces",
     *      description="Returns list of provinces",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Province")
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
        abort_if(FacadesGate::denies('province-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProvinceResource(Province::with([])->paginate());
    }

     /**
     * @OA\Post(
     *      path="/api/v1/provinces",
     *      operationId="insertProvince",
     *      tags={"Geo"},
     *      summary="Stores a new province",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/Province")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Province")
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
    public function store(ProvincePostRequest $request)
    {
        $province = Province::create($request->all());

        abort_if(FacadesGate::denies('province-post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return (new ProvinceResource($province))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/provinces/{id}",
     *      operationId="getProvince",
     *      tags={"Geo"},
     *      summary="Returns a single province",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the province which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Province")
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
    public function show(Province $province)
    {
        abort_if(FacadesGate::denies('province-get'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProvinceResource($province);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/provinces/{id}",
     *      tags={"Geo"},
     *      summary="Updates a single province",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="id",
    *          description="Province's id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Province")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Province")
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
    public function update(ProvinceUpdateRequest $request, string $id)
    {
        $province = Province::findOrFail($id);
        $province->update($request->all());

        abort_if(FacadesGate::denies('province-put-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return (new ProvinceResource($province))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/provinces/{id}",
     *      operationId="deleteProvince",
     *      tags={"Geo"},
     *      summary="Delete Existing Province",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Province's id",
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
    public function destroy(Province $province)
    {
        
        abort_if(FacadesGate::denies('province-put-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $province->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

