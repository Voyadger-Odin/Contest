<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->to(route('login'));
        }
        $validateFields = $request->validate([
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required'
        ]);

        $user = User::create(request(['name', 'email', 'password']));

        if ($user) {
            Auth::loginUsingId($user->id);
            return redirect()->to(route('tasks'));
        }

        return redirect(route('registration'))->withErrors([
            'formError' => 'Произошла ошибка'
        ]);
    }

    public function login(Request $request)
    {
        $formField = $request->only(['email', 'password']);

        // Вход по email
        if (Auth::attempt($formField)) {
            if (request()->get('url_from') != null) {
                return redirect()->to(request()->get('url_from'));
            }
            return redirect()->to(route('login'));
        }
        // Вход по логину
        $user = User::where('name', $formField['email'])->first();
        $formField['email'] = $user->email;
        if (Auth::attempt($formField)) {
            if (request()->get('url_from') != null) {
                return redirect()->to(request()->get('url_from'));
            }
            return redirect()->to(route('login'));
        }
    }
}
