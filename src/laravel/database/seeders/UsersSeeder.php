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
                'account_id' => '10001',
                'email' => 'jan@gmail.com',
                'password' => Hash::make('12345'),
                'admin_flag' => 1,
                'comment' => "店長",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '山田 大',
                'account_id' => '10002',
                'email' => 'yamada@gmail.com',
                'admin_flag' => 1,
                'password' => Hash::make('12345'),
                'comment' => "開発者",
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
