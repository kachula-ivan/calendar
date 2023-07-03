<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('main/terms', compact('user'));
    }
}
