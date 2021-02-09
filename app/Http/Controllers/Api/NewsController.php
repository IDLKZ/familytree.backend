<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index(){
        return response()->json(News::orderBy("created_at","DESC")->paginate(18));
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),["img"=>"required|image|max:4096"]);
        if(!$validator->fails()){
            News::createData($request);
            return "Added successfully";
        }
        else{
            return  response()->json(["errors"=>$validator->errors()]);
        }
    }

    public function update(Request $request){
        if($model = News::find($request->id)){
            $validator = Validator::make($request->all(),["img"=>"sometimes|nullable|image|max:4096"]);
            if(!$validator->fails()){
                return News::updateData($request,$model);
            }
            else{
                return response()->json(["errors"=>$validator->errors()]);
            }
        }
    }

    public function delete($id){
        if($model = News::find($id)){
            File::deleteImage($model->img);
            $model->delete();
        }

    }

    public function show($id){
        return response()->json(News::find($id));
    }
}
