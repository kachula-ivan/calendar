<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function account_update()
    {
        $user = Auth::user();

        return view('main/account-edit', compact('user'));
    }

    public function account_update_submit(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => ['string', 'max:100'],
            'surname' => ['string', 'max:100'],
            'avatar' => ['image', 'mimes:jpeg,png,svg', 'max:2048'],
            'phone' => ['max: 15'],
            'birthday' => ['max:15'],
            'gender' => ['max:100'],
            'address' => ['string', 'max:250'],
//            'password' => ['required',  'min:8', 'confirmed']
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $user->avatar;
            $avatar_path = substr($avatar, 1);
            try {
                unlink($avatar_path);
            } catch (\Exception) {
            }
            $image_name = $user->id . '-' . time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('users'), $image_name);
            $path = "/users/" . $image_name;
        } else {
            $path = $user->avatar;
        }


        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'avatar' => $path,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        return redirect()->route('account-update', compact('user'))->with('status', 'Дані успішно збережені.');
    }

    public function change_password(Request $request)
    {
        $user = Auth::user();

        return view('main/change-password', compact('user'));
    }

    public function update_password(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => ['required', 'min:8'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Помилка зміни паролю! Можливо ви ввели не дійсний пароль');
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect(route('account-update', compact('user')))->with('status', 'Пароль змінено успішно.');
    }

    public function change_email(Request $request)
    {
        $user = Auth::user();

        return view('main/change-email', compact('user'));
    }

    public function update_email(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'email' => ['required', 'email', 'unique:users'],
        ]);

        $user->update([
            'email' => $request->email,
            'email_verified_at' => null
        ]);

        return redirect(route('account-update', compact('user')))->with('status', 'Пошту змінено успішно.');
    }

}
















