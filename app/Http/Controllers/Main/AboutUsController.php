<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('main/about-us', compact('user'));
    }
}
