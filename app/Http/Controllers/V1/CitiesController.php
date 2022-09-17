<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityPostRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Illuminate\Support\Facades\Gate as FacadesGate;


class CitiesController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/cities",
     *      operationId="getCities",
     *      tags={"Geo"},
     *      summary="Get list of cities",
     *      description="Returns list of cities",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/City")
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
        
        // abort_if(FacadesGate::denies("cities-get"), Response::HTTP_FORBIDDEN , "403 Forbidden");

        return new CityResource(City::with([])->paginate());
    }

     /**
     * @OA\Post(
     *      path="/api/v1/cities",
     *      operationId="insertCity",
     *      tags={"Geo"},
     *      summary="Stores a new city",
     *      description="Stores record in the database",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/City")
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/City")
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
    public function store(CityPostRequest $request)
    {
        $city = City::create($request->all());

        abort_if(FacadesGate::denies('cities-post') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        return (new CityResource($city))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/cities/{id}",
     *      operationId="getCity",
     *      tags={"Geo"},
     *      summary="Returns a single city",
     *      description="Retreives record from database",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of the city which is asked for",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/City")
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
    public function show(City $city)
    {
         abort_if(FacadesGate::denies('cities-get') , Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CityResource($city);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/cities/{id}",
     *      tags={"Geo"},
     *      summary="Updates a single city",
     *      description="Updates a record in database",
    *     @OA\Parameter(
    *          name="id",
    *          description="City's id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/City")
     *         )
     *     ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/City")
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
    public function update(CityUpdateRequest $request, string $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());

        abort_if(FacadesGate::denies('cities-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        return (new CityResource($city))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/cities/{id}",
     *      operationId="deleteCity",
     *      tags={"Geo"},
     *      summary="Delete Existing City",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="City's id",
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
    public function destroy(City $city)
    {
        abort_if(FacadesGate::denies('cities-put-delete') , Response:: HTTP_FORBIDDEN , '403 Forbidden');

        $city->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

