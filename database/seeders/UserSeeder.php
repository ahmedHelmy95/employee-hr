<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            , "created_at" => now(), "updated_at" => now(),
        ];
        $user = User::create($data);
        $role = ['name' => 'admin', 'slug' => 'admin'];
        $iR = Role::create($role);
        DB::table('role_users')->insert(['user_id' => $user->id, 'role_id' => $iR->id]);
        $managers = [
            [
                'name' => 'hr',
                'email' => 'hr@employee.com',
                'position' => 'hr',
                'type' => 'hr',
                'password' => bcrypt(123456789),
                "created_at" => now(), "updated_at" => now(),
            ],
            [

                'name' => 'manager',
                'email' => 'manager@employee.com',
                'position' => 'manager',
                'type' => 'manager',
                'password' => bcrypt(123456789),
                "created_at" => now(), "updated_at" => now(),
            ],
            [

                'name' => 'manager2',
                'email' => 'manager2@employee.com',
                'position' => 'manager2',
                'type' => 'manager',
                'password' => bcrypt(123456789),
                "created_at" => now(), "updated_at" => now(),
            ],
            

        ];
        DB::table('users')->insert($managers);
        $emps = [
            [

                'name' => 'employee',
                'email' => 'employee@employee.com',
                'position' => 'employee',
                'type' => 'employee',
                'manager_id'=>2,
                'password' => bcrypt(123456789),
                "created_at" => now(), "updated_at" => now(),
            ],
            [

                'name' => 'employee2',
                'email' => 'employee2@employee.com',
                'position' => 'employee',
                'type' => 'employee',
                'manager_id'=>3,
                'password' => bcrypt(123456789),
                "created_at" => now(), "updated_at" => now(),
            ],
        ];
        DB::table('users')->insert($emps);
    }
}
