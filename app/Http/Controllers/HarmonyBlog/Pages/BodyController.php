<?php

namespace App\Http\Controllers\HarmonyBlog\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BodyController extends Controller
{
    public function index()
    {


        return view('pages.body');

    }
}
