<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EmotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emotions')->insert([
            'react' => '喜び'
        ]);
        
        DB::table('emotions')->insert([
            'react' => '悲しみ'
        ]);
        
        DB::table('emotions')->insert([
            'react' => '怒り'
        ]);
        
        DB::table('emotions')->insert([
            'react' => '驚き'
        ]);
        
        DB::table('emotions')->insert([
            'react' => '恐怖'
        ]);
        
        DB::table('emotions')->insert([
            'react' => '嫌悪'
        ]);
    }
}
