<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryAttributeRequest;
use App\Models\CategoryAttribute;
use App\Http\Resources\CategoryAttributeResource;

/***
 *** operation_object: CategoryAttribute
 *** operation_heading: Category Attribute
 ***/
class CategoryAttributeController extends Controller
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

        $query = CategoryAttribute::
        with([

            'product',
            'attribute',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $categoryAttributes = $query->paginate();

        return CategoryAttributeResource::collection($categoryAttributes);

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
            "products" => \App\Http\Resources\ProductResource::collection(\App\Models\Product::all())->toArray(),
            "attributes" => \App\Http\Resources\AttributeResource::collection(\App\Models\Attribute::all())->toArray(),
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreCategoryAttributeRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreCategoryAttributeRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $categoryattribute = CategoryAttribute::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "attributes");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($categoryattribute),
                    "object_id" => $categoryattribute->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Category Attribute Created Successfully!"
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
    function update(StoreCategoryAttributeRequest $request, int $id)
    {
        $data = $request->validated();
        $categoryattribute = CategoryAttribute::find($id);

        if (!is_object($categoryattribute)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $categoryattribute->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "attributes");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($categoryattribute),
                        "object_id" => $categoryattribute->id,
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
                "message" => "Category Attribute Updated Successfully!"
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

        $categoryattribute = CategoryAttribute::find($id);

        if (!is_object($categoryattribute)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $categoryattribute->delete();
            return response()->json([
                "code" => 200,
                "message" => "Categoryattribute Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
