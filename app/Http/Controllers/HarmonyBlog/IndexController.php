<?php

namespace App\Http\Controllers\HarmonyBlog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{



    public function index()
    {


        return view('/index');

    }

}
