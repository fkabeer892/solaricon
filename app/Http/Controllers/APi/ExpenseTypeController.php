<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExpenseTypeRequest;
use App\Models\ExpenseType;
use App\Http\Resources\ExpenseTypeResource;

/***
 *** operation_object: ExpenseType
 *** operation_heading: Expense Type
 ***/
class ExpenseTypeController extends Controller
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

        $query = ExpenseType::
        with([

            'expenses',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $expenseTypes = $query->paginate();

        return ExpenseTypeResource::collection($expenseTypes);

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
     * @param \App\Http\StoreExpenseTypeRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreExpenseTypeRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $expensetype = ExpenseType::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "expense_types");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($expensetype),
                    "object_id" => $expensetype->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Expense Type Created Successfully!"
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
    function update(StoreExpenseTypeRequest $request, int $id)
    {
        $data = $request->validated();
        $expensetype = ExpenseType::find($id);

        if (!is_object($expensetype)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $expensetype->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "expense_types");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($expensetype),
                        "object_id" => $expensetype->id,
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
                "message" => "Expense Type Updated Successfully!"
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

        $expensetype = ExpenseType::find($id);

        if (!is_object($expensetype)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $expensetype->delete();
            return response()->json([
                "code" => 200,
                "message" => "Expensetype Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
