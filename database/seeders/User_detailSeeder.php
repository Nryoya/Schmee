<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class User_detailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Users_detail')->insert([
            'users_id' => 5,
            'grade' => 3,
            'class' => 1,
            'onething' => 'よろしくお願いします。',
            'tel' => '08000000000',
            'address' => '神奈川県〇〇市〇〇1-1-1',
            'emergency' => '09000000000',
            'relationship' => '母',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
