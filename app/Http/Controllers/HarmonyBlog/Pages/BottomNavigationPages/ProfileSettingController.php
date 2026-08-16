<?php

namespace App\Http\Controllers\HarmonyBlog\Pages\BottomNavigationPages;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfileSettingController extends Controller
{
    public function __construct(
        private readonly ProfileRepositoryInterface $profiles
    ) {
    }

    public function index(Request $request): View
    {
        $user = $this->profiles->find($request->user()->id);

        return view('pages.bottomNavigationPages.profilesetting', ['user' => $user]);
    }
}
