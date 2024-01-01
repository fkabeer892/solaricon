<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderItemRequest;
use App\Models\OrderItem;
use App\Http\Resources\OrderItemResource;

/***
 *** operation_object: OrderItem
 *** operation_heading: Order Item
 ***/
class OrderItemController extends Controller
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

        $query = OrderItem::
        with([

            'user',
            'product',
            'order',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $orderItems = $query->paginate();

        return OrderItemResource::collection($orderItems);

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
            "products" => \App\Http\Resources\ProductResource::collection(\App\Models\Product::all())->toArray(),
            "orders" => \App\Http\Resources\OrderResource::collection(\App\Models\Order::all())->toArray(),
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreOrderItemRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreOrderItemRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $orderitem = OrderItem::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "orders");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($orderitem),
                    "object_id" => $orderitem->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Order Item Created Successfully!"
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
    function update(StoreOrderItemRequest $request, int $id)
    {
        $data = $request->validated();
        $orderitem = OrderItem::find($id);

        if (!is_object($orderitem)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $orderitem->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "orders");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($orderitem),
                        "object_id" => $orderitem->id,
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
                "message" => "Order Item Updated Successfully!"
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

        $orderitem = OrderItem::find($id);

        if (!is_object($orderitem)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $orderitem->delete();
            return response()->json([
                "code" => 200,
                "message" => "Orderitem Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
