<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function data(){
        $news = News::all()->take(6);
        return response()->json($news);
    }
}
