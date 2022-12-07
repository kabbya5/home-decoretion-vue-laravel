<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ImagablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagable = [];
        $type = ['App\Models\Product','App\Models\Tag'];

        for($i = 0; $i<80;$i++){
            $imagable = [
                'imageble_type' => $type[rand(0,1)],
                'imageble_id' => rand(1,50),
                'image_id' => rand(1,50),
            ];
            DB::table('imagebles')->insert($imagable);
        }
    }
}
