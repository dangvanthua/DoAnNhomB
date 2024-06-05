<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Support\Str;

class CrudUserController extends Controller
{
    public function login()
    {
        return view('crud.login');
    }

    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentals = $request->only('email', 'password');

        if (Auth::attempt($credentals)) {
            Session::push('user', Auth::user()['is_admin']);
            return redirect()->intended('home')->with('success', "Login successfully :)");
        }

        return redirect('login')->with('success', "Login failed :(");
    }

    public function register()
    {
        return view('crud.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'user_name' => 'required|max:100',
            'password' => 'required',
            'retype' => 'required|same:password',
            'full_name' => 'required',
            'phone_number' => 'nullable',
            'email' => 'required|email|max:255|unique:users',
            'date_of_birth' => 'required',
            'user_image' => 'required|image'
        ]);

        $data = $request->all();

        $fileName = "";
        if ($request->hasFile('user_image')) {
            $file = $request->file('user_image');
            $fileName = $file->getFilename() . "." . $file->extension();
            $file->move('upload/', $fileName);
        }

        $user = User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'email_verified_at' => date_create(datetime: now()),
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(10)
        ]);

        $profile = UserDetail::create([
            'user_id' => $user['user_id'],
            'phone_number' => $data['phone_number'],
            'date_of_birth' => $data['date_of_birth'],
            'sex' => $data['sex'],
            'user_image' => $fileName,
            'full_name' => $data['full_name']
        ]);

        return redirect('login')->with('message', 'Register successfully');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('login');
    }

    public function viewAccountInfo()
    {
        if (isset(session('user')[0])) {
            return view('crud.account');
        }
        return redirect('login');
    }

    public function listUser()
    {
        if (isset(session('user')[0])) {
            $users = User::all();
            return view('crud.list_user', ['users' => $users]);
        }
    }
}
