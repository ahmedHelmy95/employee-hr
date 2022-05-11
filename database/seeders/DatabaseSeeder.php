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
            , "created_at" => now(), "updated_at" => now(),
        ];
        $user = User::create($data);
        $role = ['name' => 'admin', 'slug' => 'admin'];
        $iR = Role::create($role);
        DB::table('role_users')->insert(['user_id' => $user->id, 'role_id' => $iR->id]);
        $emps = [
            [

                'name' => 'employee',
                'email' => 'employee@employee.com',
                'position' => 'employee',
                'type' => 'employee',
                'password' => bcrypt(123456789),
                "created_at" => now(), "updated_at" => now(),
            ],
            [

                'name' => 'employee2',
                'email' => 'employee2@employee.com',
                'position' => 'employee',
                'type' => 'employee',
                'password' => bcrypt(123456789),
                "created_at" => now(), "updated_at" => now(),
            ],
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

        ];
        DB::table('users')->insert($emps);

        $leave_types = [
            ['name' => 'اجازة رسمية', "created_at" => now(), "updated_at" => now()],
            ['name' => 'اجازة مرضية', "created_at" => now(), "updated_at" => now()],
            ['name' => 'اجازة اعتيادية', "created_at" => now(), "updated_at" => now()],
        ];

        DB::table('leave_types')->insert($leave_types);

    }
}
