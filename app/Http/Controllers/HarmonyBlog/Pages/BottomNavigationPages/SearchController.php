<?php

namespace App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {


        return view('/pages.bottomNavigationPages.search');

    }
}
