<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactDetailRequest;
use App\Models\ContactDetail;
use App\Http\Resources\ContactDetailResource;

/***
 *** operation_object: ContactDetail
 *** operation_heading: Contact Detail
 ***/
class ContactDetailController extends Controller
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

        $query = ContactDetail::
        with([

            'contact',

        ]);

        $keyword = $request->get("keyword");

        if ($keyword) {
            $query->where("name", "like", "%{$keyword}%");
        }

        $contactDetail = $query->paginate();

        return ContactDetailResource::collection($contactDetail);

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
     * @param \App\Http\StoreContactDetailRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreContactDetailRequest $request)
    {
        $data = $request->validated();
        $data = array_filter($data);


        try {
            $contactdetail = ContactDetail::create($data);

            if ($request->hasFile("logo")) {

                $uploader = new \App\Services\Uploader("logo", "contacts");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($contactdetail),
                    "object_id" => $contactdetail->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Contact Detail Created Successfully!"
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
    function update(StoreContactDetailRequest $request, int $id)
    {
        $data = $request->validated();
        $contactdetail = ContactDetail::find($id);

        if (!is_object($contactdetail)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $contactdetail->update($data);
            if ($request->hasFile("logo")) {
                try {
                    $uploader = new \App\Services\Uploader("logo", "contacts");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($contactdetail),
                        "object_id" => $contactdetail->id,
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
                "message" => "Contact Detail Updated Successfully!"
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

        $contactdetail = ContactDetail::find($id);

        if (!is_object($contactdetail)) {
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try {
            $contactdetail->delete();
            return response()->json([
                "code" => 200,
                "message" => "Contactdetail Deleted Successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
