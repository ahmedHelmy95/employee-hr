<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'type' => 'admin',
            'password' => bcrypt(123456789)
        ];
        $user = User::create($data); 
        $role =['name'=>'admin','slug'=>'admin'];
        $iR =  Role::create($role);
        DB::table('role_users')->insert(['user_id'=>$user->id,'role_id'=>$iR->id]);



        $emps = [
            [

                'name' => 'employee',
                'email' => 'employee@employee.com',
                'position' => 'employee',
                'type' => 'employee',
                'password' => bcrypt(123456789),
            ],
            [

                'name' => 'hr',
                'email' => 'hr@employee.com',
                'position' => 'hr',
                'type' => 'hr',
                'password' => bcrypt(123456789),
            ],
            [

                'name' => 'manager',
                'email' => 'manager@employee.com',
                'position' => 'manager',
                'type' => 'manager',
                'password' => bcrypt(123456789),
            ],

        ];
        DB::table('users')->insert($emps);


    }
}
