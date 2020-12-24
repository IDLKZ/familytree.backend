<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;

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
        return Family::familyTree();
    }
}
