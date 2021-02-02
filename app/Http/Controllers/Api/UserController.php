<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
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
        $tree = Family::familyTree();
        return response()->json($tree);
    }

    public function test(Request $request){
        $test = new Test();
        $test->data = json_encode($request->get("media"));
        $test->save();
    }
    public function showData(){
        $test = json_decode((Test::find(1))->data,1);
        dd($test);

    }
}
