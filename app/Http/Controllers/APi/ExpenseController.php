<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExpenseRequest;
use App\Models\Expense;
use App\Http\Resources\ExpenseResource;

/***
 *** operation_object: Expense
 *** operation_heading: Expense
 ***/
class ExpenseController extends Controller
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

        $query = Expense::
        with([

            'status',
            'expenseType',
            'branch',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $expenses = $query->paginate();

        return ExpenseResource::collection($expenses);

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
            "expenseTypes" => \App\Http\Resources\ExpenseTypeResource::collection(\App\Models\ExpenseType::all())->toArray(),
            "branches" => \App\Http\Resources\BranchResource::collection(\App\Models\Branch::all())->toArray(),
        ];


        return $data;
    }

    /**
     * Store new record
     * @param \App\Http\StoreExpenseRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreExpenseRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $expense = Expense::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "branches");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($expense),
                    "object_id" => $expense->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Expense Created Successfully!"
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
    function update(StoreExpenseRequest $request, int $id)
    {
        $data = $request->validated();
        $expense = Expense::find($id);

        if (!is_object($expense)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $expense->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "branches");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($expense),
                        "object_id" => $expense->id,
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
                "message" => "Expense Updated Successfully!"
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

        $expense = Expense::find($id);

        if (!is_object($expense)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $expense->delete();
            return response()->json([
                "code" => 200,
                "message" => "Expense Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
