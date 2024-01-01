<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use App\Http\Resources\ImageResource;

/***
*** operation_object: Image
*** operation_heading: Image
***/

class ImageController extends Controller
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

        $query = Image::
        
        query()
        ;

        $keyword = $request->get("keyword");

        if($keyword){
            $query->where("name", "like", "%{$keyword}%");
        }

        $images = $query->paginate();

        return ImageResource::collection($images);

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
     * @param  \App\Http\StoreImageRequest $request
     * @return  \Illuminate\Http\Resources\Json\JsonResource
     */

    /***
     * operation_name: create
     * operation_label: Create
     */
    function store(StoreImageRequest $request){
        $data = $request->validated();
        $data = array_filter($data);


        try{
            $image = Image::create($data);

            if($request->hasFile("logo")){

                $uploader = new \App\Services\Uploader("logo", "images");
                $filename = $uploader->upload();
                \App\Models\Image::create([
                    "object_type" => get_class($image),
                    "object_id" => $image->id,
                    "name" => "logo",
                    "type" => "image",
                    "file_name" => $filename
                ]);

            }
            return response()->json([
                "code" => 200,
                "message" => "Image Created Successfully!"
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
    function update(StoreImageRequest $request, int $id){
        $data = $request->validated();
        $image = Image::find($id);

        if(!is_object($image)){
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try{
            $image->update($data);
            if($request->hasFile("logo")){
                try {
                    $uploader = new \App\Services\Uploader("logo", "images");
                    $file = $uploader->upload();
                    \App\Models\Image::create([
                        "object_type" => get_class($image),
                        "object_id" => $image->id,
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
                "message" => "Image Updated Successfully!"
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

        $image = Image::find($id);

        if(!is_object($image)){
            return response()->json([
                "code" => 404,
                "message" => "No record associated with id '{$id}' found"
            ], 404);
        }

        try{
            $image->delete();
            return response()->json([
                "code" => 200,
                "message" => "Image Deleted Successfully!"
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
