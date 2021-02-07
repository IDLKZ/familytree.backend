<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function index(){
        return response()->json(Gallery::orderBy("created_at","DESC")->paginate(18));
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),["img"=>"required|image|max:4096"]);
        if(!$validator->fails()){
            Gallery::createData($request);
            return "Added successfully";
        }
        else{
            return  response()->json(["errors"=>$validator->errors()]);
        }
    }

    public function update(Request $request){
        if($model = Gallery::find($request->id)){
            $validator = Validator::make($request->all(),["img"=>"sometimes|nullable|image|max:4096"]);
            if(!$validator->fails()){
                return Gallery::updateData($request,$model);
            }
            else{
                return response()->json(["errors"=>$validator->errors()]);
            }
        }
    }

    public function delete($id){
        if($model = Gallery::find($id)){
            File::deleteImage($model->img);
            $model->delete();
            }

        }


}
