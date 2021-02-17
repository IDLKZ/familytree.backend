<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\File;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function add(Request $request)
    {

        if (Family::saveData($request)) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    public function get()
    {
        $users = Family::all();
        return response()->json($users);
    }

    public function treeFamily(){
//        $tree = Family::familyTree();
        $tree = Family::treeFamily();
        return response()->json($tree);
    }

    public function treeFamily2(){
        $tree = Family::familyTree();
//        $tree = Family::treeFamily();
        return response()->json($tree);
    }


    public function member(){
        if ((Family::all())->count() > 6){
            return response()->json(Family::get()->random(6));
        }
        else{
            return response()->json(Family::get());
        }
    }

    public function family()
    {
        $users = Family::paginate(10);
        foreach ($users as $k => $v) {
            if ($v['parent_id'] != null) {
                $pid = Family::find($v['parent_id']);
            } else {
                $pid['name'] = 'Первый потомок';
            }
            $users[$k]['parent_id'] = $pid['name'];
        }
        return response()->json($users);
    }

    public function getUser($id)
    {
        $user = Family::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $model = Family::find($id);
        Family::updateData($request, $model);
    }

    public function search (Request $request){
        $search = $request->get('q');
        if ($search) {
            $publications = Family::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->paginate(10);
        }else{
            $publications = Family::latest()->paginate(10);
        }
        return $publications;
    }

    public function deleteFamily($id)
    {
        $user = Family::with('descendants')->where('id', $id)->first();
        foreach ($user->descendants as $item) {
            File::deleteImage($item->img);
            $item->delete();
        }
        File::deleteImage($user->img);
        $user->delete();
    }

}
