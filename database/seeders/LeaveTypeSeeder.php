<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $leave_types = [
            ['name' => 'اجازة رسمية', "created_at" => now(), "updated_at" => now()],
            ['name' => 'اجازة مرضية', "created_at" => now(), "updated_at" => now()],
            ['name' => 'اجازة اعتيادية', "created_at" => now(), "updated_at" => now()],
        ];

        DB::table('leave_types')->insert($leave_types);
    }
}
