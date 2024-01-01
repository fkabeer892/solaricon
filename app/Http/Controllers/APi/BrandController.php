<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use App\Http\Resources\BrandResource;

/***
 *** operation_object: Brand
 *** operation_heading: Brand
 ***/
class BrandController extends Controller
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

        $query = Brand::
        with([

            'products',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $brands = $query->paginate();

        return BrandResource::collection($brands);

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
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreBrandRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreBrandRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $brand = Brand::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "brands");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($brand),
                    "object_id" => $brand->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Brand Created Successfully!"
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
    function update(StoreBrandRequest $request, int $id)
    {
        $data = $request->validated();
        $brand = Brand::find($id);

        if (!is_object($brand)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $brand->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "brands");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($brand),
                        "object_id" => $brand->id,
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
                "message" => "Brand Updated Successfully!"
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

        $brand = Brand::find($id);

        if (!is_object($brand)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $brand->delete();
            return response()->json([
                "code" => 200,
                "message" => "Brand Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
