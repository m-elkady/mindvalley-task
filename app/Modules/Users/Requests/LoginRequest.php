<?php

namespace App\Modules\Users\Requests;

use App\Base\Request;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends Request
{

    public function attributes()
    {
        return ['username', 'password'];
    }

    public function rules()
    {
        return [
          'username' => ['required'],
          'password' => ['required'],
        ];
    }

    public function process()
    {
        if ($this->validate()) {
            if (Auth::attempt($this->getAttributes(), 1)) {
                flash('Welcome back! ' . $this->username)->success();

                return redirect(route('admin.home'));
            }
        }

        flash('Bad Credentials')->error();

        return redirect(route('admin.login'))->with($this->errors);
    }

}