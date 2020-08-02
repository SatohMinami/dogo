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
            return redirect()->route('web.auth.login')
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
        $staff = Staff::where('code', 58)->first();
        if (empty($staff)) {
            Staff::create([
                'code' => 58,
                'email' => 'admin@ominext.com',
                'first_name' => 'Pham',
                'last_name' => 'Tam',
                'full_name' => 'Pham Tam',
                'rank_id' => 1,
                'grade_id' => '1',
                'department_id' => 1,
                'role' => Staff::ROLE_ADMIN,
                'last_access_at' => date('Y-m-d H:i:s', time()),
                'remember_token' => null,
                'password' => Hash::make('123456'),
                'created_id' => 1,
                'updated_id' => 1,
            ]);
        }
        return redirect()->route('web.auth.login');
    }
}
