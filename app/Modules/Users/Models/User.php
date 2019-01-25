<?php

namespace App\Modules\Users\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    const ADMIN_TYPE = '1';
    public $table = 'users';


    public function isAdmin()
    {
        if ($this->role == static::ADMIN_TYPE) {
            return true;
        }

        return false;
    }
}