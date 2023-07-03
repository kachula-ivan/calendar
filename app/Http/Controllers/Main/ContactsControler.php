<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactsControler extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('main/contacts', compact('user'));
    }
}
