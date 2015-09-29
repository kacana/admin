<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    // Rest of AuthController class...

    public function getLogin()
    {
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $email = $request->input('email', false);
        $password = $request->input('password', false);

        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('/');
        }
    }
}