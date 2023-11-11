<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'name' => 'ジェン',
                'email' => 'jen@gmail.com',
                'password' => Hash::make('12345'),
                'admin_flag' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '山田 大',
                'email' => 'yamada@gmail.com',
                'admin_flag' => 1,
                'password' => Hash::make('12345'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
