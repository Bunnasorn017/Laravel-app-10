<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //Register
    public function Resigter()
    {
        return view('auth.registration');
    }

    public function resigteruser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:12',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $result = $user->save();
        if ($result) {
            return back()->with('success', 'Your accunt has been successfully');
        } else {
            return back()->with('fail', 'Something wrong!');
        }
    }

    //Login
    public function Login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:12',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'Password not match');
            }
        } else {
            return back()->with('fail', 'This email does not register');
        }
    }

    public function Dashboard()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('auth.dashboard', compact('data'));
    }

    public function logout()
    {
        $data = array();
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('auth.login');
        }
    }
}
