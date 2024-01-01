<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRoleRequest;
use App\Models\UserRole;
use App\Http\Resources\UserRoleResource;

/***
 *** operation_object: UserRole
 *** operation_heading: User Role
 ***/
class UserRoleController extends Controller
{
    function __construct()
    {
        parent::__construct($this);
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: list
     * operation_label: List
     */
    function index(Request $request)
    {

        $query = UserRole::
        with([

            'user',
            'role',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $userRoles = $query->paginate();

        return UserRoleResource::collection($userRoles);

    }

    /**
     * Form data required to add new record
     * @param \Illuminate\Http\Request $request
     * @return  Array;
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function data(Request $request)
    {

        $data = [
            "users" => \App\Http\Resources\UserResource::collection(\App\Models\User::all())->toArray(),
            "roles" => \App\Http\Resources\RoleResource::collection(\App\Models\Role::all())->toArray(),
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreUserRoleRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreUserRoleRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $userrole = UserRole::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "roles");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($userrole),
                    "object_id" => $userrole->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "User Role Created Successfully!"
            ], 201);

        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }



    /**
     * Update record
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: edit
     * operation_label: Edit
     */
    function update(StoreUserRoleRequest $request, int $id)
    {
        $data = $request->validated();
        $userrole = UserRole::find($id);

        if (!is_object($userrole)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $userrole->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "roles");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($userrole),
                        "object_id" => $userrole->id,
                        "name" => "logo",
                        "image" => $file
                    ]);
                } catch (\Exception $ex) {
                    return response()->json([
                        "code" => 500,
                        "message" => $ex->getMessage()
                    ], 500);
                }

            }

            return response()->json([
                "code" => 200,
                "message" => "User Role Updated Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Delete record
     * @param integer $id
     * @return  \Illuminate\Http\Resources\Json\JsonResource;
     */

    /***
     * operation_name: delete
     * operation_label: Delete
     */
    function destroy(int $id)
    {

        $userrole = UserRole::find($id);

        if (!is_object($userrole)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $userrole->delete();
            return response()->json([
                "code" => 200,
                "message" => "User role Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
