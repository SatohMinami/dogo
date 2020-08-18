<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }
        if ($request->isMethod('POST')) {
            //Xu li login
            $email = $request['email'];
            $password = $request['password'];
            $remember = empty($request['remember']) ? $request['remember'] : 0;
            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                return redirect()->route('admin.home');
            }
            return redirect()->route('auth.login')
                ->withErrors(['Email hoặc mật khẩu không chính xác!'])
                ->withInput();
        }

        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function create()
    {
            User::create([
                'id' => 1,
                'name' => 'name',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin@admin.com')]);
        return redirect()->route('auth.login');
    }
}
