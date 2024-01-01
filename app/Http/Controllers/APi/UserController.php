<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Http\Resources\UserResource;

/***
 *** operation_object: User
 *** operation_heading: User
 ***/
class UserController extends Controller
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

        $query = User::
        with([

            'userRoles',
            'orderItems',
            'orders',
            'contacts',
            'cms',
            'carts',
            'status',
            'role',
            'contact',
            'branch',
            'branch',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $users = $query->paginate();

        return UserResource::collection($users);

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
            "statuses" => \App\Http\Resources\StatusResource::collection(\App\Models\Status::all())->toArray(),
            "roles" => \App\Http\Resources\RoleResource::collection(\App\Models\Role::all())->toArray(),
            "contacts" => \App\Http\Resources\ContactResource::collection(\App\Models\Contact::all())->toArray(),
            "branches" => \App\Http\Resources\BranchResource::collection(\App\Models\Branch::all())->toArray(),
            "branch" => \App\Http\Resources\BranchResource::collection(\App\Models\Branch::all())->toArray(),
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreUserRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $user = User::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($user),
                    "object_id" => $user->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "User Created Successfully!"
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
    function update(StoreUserRequest $request, int $id)
    {
        $data = $request->validated();
        $user = User::find($id);

        if (!is_object($user)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $user->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($user),
                        "object_id" => $user->id,
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
                "message" => "User Updated Successfully!"
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

        $user = User::find($id);

        if (!is_object($user)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $user->delete();
            return response()->json([
                "code" => 200,
                "message" => "User Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
