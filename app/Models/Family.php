<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Collection;

class Family extends Model
{
    use HasFactory;
    protected $table = 'families';
    protected $fillable = ['name', 'img', 'parent_id', 'description',"number"];

    public static function saveData($request)
    {
        $model = new self();
        $input = $request->all();
        $input["img"] = $request->hasFile("img") ? File::saveImage($request['img'],"/uploads/users/") : "/no-image.png";
        $model->fill($input);
        $model->save();
        return $model;
    }

    public static function familyTree(){
        $raw = Family::get()->keyBy("id")->toArray();
       $tree = [];
       foreach ($raw as $id=>&$node){
           if(!$node["parent_id"]){
               $tree = &$node;
//               $tree[$id] = &$node;
           }
           else{
               $raw[$node["parent_id"]]["children"][] = &$node;
           }
       }
       return $tree;

    }

    public static function treeFamily()
    {
        $data = Family::all();
        $nodes = [];
        foreach ($data as $datum) {
            $nodes[] = collect(['id' => $datum->id, 'pid' => $datum->parent_id, 'name' => $datum->name, 'title' => $datum->description, 'img' => "http://backend.qangli.kz/".$datum->img]);
        }
        return $nodes;
    }


}
