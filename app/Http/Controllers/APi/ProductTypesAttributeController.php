<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductTypesAttributeRequest;
use App\Models\ProductTypesAttribute;
use App\Http\Resources\ProductTypesAttributeResource;

/***
 *** operation_object: ProductTypesAttribute
 *** operation_heading: Product Types Attribute
 ***/
class ProductTypesAttributeController extends Controller
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

        $query = ProductTypesAttribute::
        with([

            'productType',
            'attribute',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $productTypesAttributes = $query->paginate();

        return ProductTypesAttributeResource::collection($productTypesAttributes);

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
            "productTypes" => \App\Http\Resources\ProductTypeResource::collection(\App\Models\ProductType::all())->toArray(),
            "attributes" => \App\Http\Resources\AttributeResource::collection(\App\Models\Attribute::all())->toArray(),
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreProductTypesAttributeRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreProductTypesAttributeRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $producttypesattribute = ProductTypesAttribute::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "attributes");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($producttypesattribute),
                    "object_id" => $producttypesattribute->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Product Types Attribute Created Successfully!"
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
    function update(StoreProductTypesAttributeRequest $request, int $id)
    {
        $data = $request->validated();
        $producttypesattribute = ProductTypesAttribute::find($id);

        if (!is_object($producttypesattribute)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $producttypesattribute->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "attributes");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($producttypesattribute),
                        "object_id" => $producttypesattribute->id,
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
                "message" => "Product Types Attribute Updated Successfully!"
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

        $producttypesattribute = ProductTypesAttribute::find($id);

        if (!is_object($producttypesattribute)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $producttypesattribute->delete();
            return response()->json([
                "code" => 200,
                "message" => "Producttypesattribute Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
