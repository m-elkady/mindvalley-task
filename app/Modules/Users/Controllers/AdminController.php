<?php

namespace App\Modules\Users\Controllers;

use App\Base\Controller;
use App\Modules\Users\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('Users.Views.login');
    }

    public function handleLogin()
    {
        $request = new LoginRequest();
        $data = $this->request->all();
        return $request->load($data)->process();


    }

    public function home()
    {
        return view('Users.Views.home');
    }


    public function logout()
    {
        Auth::logout();
        return redirect(route('admin.login'));
    }

}