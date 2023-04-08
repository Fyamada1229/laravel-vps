<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('products')->insert([
            [
                'name' => 'ガパオライス (Gapao Rice)',
                'price' => '800',
                'note' => 'タイのライス',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'トムヤムクン (Tom Yum Goong)',
                'price' => '950',
                'note' => 'タイのラーメン',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'パッタイ (Pad Thai)',
                'price' => '800',
                'note' => 'タイのやきそば',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
