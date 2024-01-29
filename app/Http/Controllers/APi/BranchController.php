<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchRequest;
use App\Models\Branch;
use App\Http\Resources\BranchResource;

/***
 *** operation_object: Branch
 *** operation_heading: Branch
 ***/
class BranchController extends Controller
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

        $query = Branch::
        with([

            'contact',
            'users',
            'expenses',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%")
                ->orWhereHas("contact", function ($rel) use($keyword){
                    $rel->where("address", "like", "%{$keyword}%")
                        ->orWhere("area", "like", "%{$keyword}%")
                        ->orWhere("city", "like", "%{$keyword}%")
                        ->orWhere("state", "like", "%{$keyword}%")
                    ;
                });
        }

        $branches = $query->paginate();

        return BranchResource::collection($branches);

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
            "contacts" => \App\Http\Resources\ContactResource::collection(\App\Models\Contact::all())->toArray(),
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreBranchRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreBranchRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $branch = Branch::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "contacts");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($branch),
                    "object_id" => $branch->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Branch Created Successfully!"
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
    function update(StoreBranchRequest $request, int $id)
    {
        $data = $request->validated();
        $branch = Branch::find($id);

        if (!is_object($branch)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $branch->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "contacts");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($branch),
                        "object_id" => $branch->id,
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
                "message" => "Branch Updated Successfully!"
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

        $branch = Branch::find($id);

        if (!is_object($branch)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $branch->delete();
            return response()->json([
                "code" => 200,
                "message" => "Branch Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
