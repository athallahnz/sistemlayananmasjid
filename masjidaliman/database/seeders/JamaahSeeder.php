<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JamaahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jamaahs')->insert([
            [
                'nama' => 'atha',
                'nomor' => 6285231161434,
                'infaq_id' => 1
            ],
            [
                'nama' => 'afifah',
                'nomor' => 628232826422,
                'infaq_id' => 2
            ],
            [
                'nama' => 'zuhdhi',
                'nomor' => 6285231161455,
                'infaq_id' => 3
            ],
        ]);
    }
}
