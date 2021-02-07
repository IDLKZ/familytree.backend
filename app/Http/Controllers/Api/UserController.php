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


    public function member(){
        return response()->json(Family::get()->random(6));
    }
}
