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
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make('12345'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('12345'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('12345'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
