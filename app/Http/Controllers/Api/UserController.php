<?php

namespace App\Http\Controllers\Api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function index()
    {
        $data =  $this->userRepositoryInterface->index();
        return  ApiResponseClass::sendResponse(UserResource::collection($data), '', 200);
    }

    public function show($id)
    {
        $user =  $this->userRepositoryInterface->getById($id);
        return  ApiResponseClass::sendResponse(new UserResource($user), '', 200);
    }

    public function store(StoreUserRequest $request)
    {
        $data = [
            'rol_id' => $request->rol_id,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'user' => $request->user,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'status' => $request->status,
        ];


        DB::beginTransaction();
        try {
            $user = $this->userRepositoryInterface->store($data);
            DB::commit();
            return  ApiResponseClass::sendResponse(new UserResource($user), 'Usuario creado con exito', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return  ApiResponseClass::rollback($e);
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = [
            'rol_id' => $request->rol_id,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'user' => $request->user,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'status' => $request->status,
        ];

        DB::beginTransaction();
        try {
            $user = $this->userRepositoryInterface->update($data, $id);
            DB::commit();
            return  ApiResponseClass::sendResponse(null, 'Usuario actualizado con exito', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return  ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id)
    {
        $this->userRepositoryInterface->delete($id);
        return  ApiResponseClass::sendResponse(null, 'Usuario eliminado con exito', 204);
    }

    //Login
}
