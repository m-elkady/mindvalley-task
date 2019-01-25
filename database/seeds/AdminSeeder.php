<?php

use Illuminate\Database\Seeder;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(){
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'role' => User::ADMIN_TYPE,
        ]);
    }

}