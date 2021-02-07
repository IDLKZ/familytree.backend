<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public static function createData($request){
    $model = new self();
    $model["title"] = $request->title;
    $model["img"] = File::saveImage($request->file("img"),"/uploads/galleries/");
    return $model->save();
    }
    public static function updateData($request,$model){
        if($request->hasFile("img")){
            File::deleteImage($model->img);
            $model->img = File::saveImage($request->file("img"),"/uploads/galleries/");
        }
        $model->title = $request->title;
        return $model->save();
    }

}
