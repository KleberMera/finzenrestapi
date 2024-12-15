<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Http\Resources\CategoriesResource;
use App\Interfaces\CategoriesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    private CategoriesRepositoryInterface $categoriesRepositoryInterface;

    public function __construct(CategoriesRepositoryInterface $categoriesRepositoryInterface)
    {
        $this->categoriesRepositoryInterface = $categoriesRepositoryInterface;
    }


    public function index()
    {
        $data = $this->categoriesRepositoryInterface->index();

        return ApiResponseClass::sendResponse(CategoriesResource::collection($data), '', 200);
    }


    public function store(StoreCategoriesRequest $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
        ];


        DB::beginTransaction();
        try {
            $user = $this->categoriesRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseClass::sendResponse(new CategoriesResource($user), 'Categoría ' . $data['name'] . ' creada con éxito', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return  ApiResponseClass::rollback($e);
        }
    }

    public function show($id)
    {
        $category =  $this->categoriesRepositoryInterface->getById($id);
        return  ApiResponseClass::sendResponse(new CategoriesResource($category), '', 200);
    }




    public function update(UpdateCategoriesRequest $request, $id)
    {
        $data = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
        ];

        DB::beginTransaction();
        try {
            $category = $this->categoriesRepositoryInterface->update($data, $id);
            DB::commit();
            return  ApiResponseClass::sendResponse(null, 'Usuario actualizado con exito', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return  ApiResponseClass::rollback($e);
        }
    }


    public function destroy($id)
    {
        $this->categoriesRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Product Delete Successful', '', 204);
    }
}
