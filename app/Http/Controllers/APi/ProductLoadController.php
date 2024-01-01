<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductLoadRequest;
use App\Models\ProductLoad;
use App\Http\Resources\ProductLoadResource;

/***
*** operation_object: ProductLoad
*** operation_heading: Product Load
***/

class ProductLoadController extends Controller
{
    function __construct(){
        parent::__construct($this);
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: list
     * operation_label: List
     */
    function index(Request $request){

        $query = ProductLoad::
        
        query()
        ;

        $keyword = $request->get("keyword");

        if($keyword){
            $query->where("name", "like", "%{$keyword}%");
        }

        $productLoads = $query->paginate();

        return ProductLoadResource::collection($productLoads);

    }

    /**
     * Form data required to add new record
     * @param  \Illuminate\Http\Request $request
     * @return  Array;
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function data(Request $request){

        $data = [
        ];


        return $data;
    }

    /**
     * Store new record
     * @param  \App\Http\StoreProductLoadRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreProductLoadRequest $request){
        $data = $request->validated();
        $data = array_filter($data);


        try{
            $productload = ProductLoad::create($data);

            if($request->hasFile("logo")){

                $uploader = new \App\Services\Uploader("logo", "product_loads");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($productload),
                    "object_id" => $productload->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Product Load Created Successfully!"
            ], 201);

        }
        catch (\Exception $ex){
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }



    /**
     * Update record
     * @param  \Illuminate\Http\Request $request
     * @param  integer $id
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: edit
     * operation_label: Edit
     */
    function update(StoreProductLoadRequest $request, int $id){
        $data = $request->validated();
        $productload = ProductLoad::find($id);

        if(!is_object($productload)){
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try{
            $productload->update($data);
            if($request->hasFile("logo")){
                try {
                    $uploader = new \App\Services\Uploader("logo", "product_loads");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($productload),
                        "object_id" => $productload->id,
                        "name" => "logo",
                        "image" => $file
                    ]);
                }
                catch (\Exception $ex){
                    return response()->json([
                        "code" => 500,
                        "message" => $ex->getMessage()
                    ], 500);
                }

            }

            return response()->json([
                "code" => 200,
                "message" => "Product Load Updated Successfully!"
            ], 200);
        }
        catch (\Exception $ex){
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Delete record
     * @param  integer $id
     * @return  \Illuminate\Http\Resources\Json\JsonResource;
     */

    /***
     * operation_name: delete
     * operation_label: Delete
     */
    function destroy(int $id){

        $productload = ProductLoad::find($id);

        if(!is_object($productload)){
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try{
            $productload->delete();
            return response()->json([
                "code" => 200,
                "message" => "Productload Deleted Successfully!"
            ], 200);
        }
        catch (\Exception $ex){
            return response()->json([
                "code" => 500,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}
