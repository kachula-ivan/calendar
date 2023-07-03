<?php

namespace App\Http\Controllers\Friend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');

        if (!$query)
        {
            redirect()->route('search-results');
        }

        $users = User::where(DB::raw("CONCAT (name, ' ', surname)"),
                                'LIKE', "%{$query}%")
                                ->orWhere('email', 'LIKE', "%{$query}%")
                                ->paginate(20);

        return view('friends/find', compact('user', 'users'));
    }
}
