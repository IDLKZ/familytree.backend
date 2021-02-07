<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public static function createData($request){
        $model = new self();
        $model["title"] = $request->title;
        $model["img"] = File::saveImage($request->file("img"),"/uploads/news/");
        $model["content"] = $request->content;
        return $model->save();
    }
    public static function updateData($request,$model){
        if($request->hasFile("img")){
            File::deleteImage($model->img);
            $model->img = File::saveImage($request->file("img"),"/uploads/news/");
        }
        $model->title = $request->title;
        $model->content = $request->content;
        return $model->save();
    }
}
