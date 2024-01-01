<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Http\Resources\ProductResource;

/***
 *** operation_object: Product
 *** operation_heading: Product
 ***/
class ProductController extends Controller
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

        $query = Product::
        with([

            'productAttributes',
            'orderItems',
            'categoryAttributes',
            'cartItems',
            'productType',
            'category',
            'brand',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $products = $query->paginate();

        return ProductResource::collection($products);

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
            "categories" => \App\Http\Resources\CategoryResource::collection(\App\Models\Category::all())->toArray(),
            "brands" => \App\Http\Resources\BrandResource::collection(\App\Models\Brand::all())->toArray(),
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreProductRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $product = Product::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "brands");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($product),
                    "object_id" => $product->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Product Created Successfully!"
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
    function update(StoreProductRequest $request, int $id)
    {
        $data = $request->validated();
        $product = Product::find($id);

        if (!is_object($product)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $product->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "brands");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($product),
                        "object_id" => $product->id,
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
                "message" => "Product Updated Successfully!"
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

        $product = Product::find($id);

        if (!is_object($product)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $product->delete();
            return response()->json([
                "code" => 200,
                "message" => "Product Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
