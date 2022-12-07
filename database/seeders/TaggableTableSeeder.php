<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

use function PHPSTORM_META\type;

class TaggableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $taggable = [];

        for($i = 0; $i<70; $i++){
            $taggable = [
                'taggable_type' => 'App\Models\Product',
                'taggable_id' => rand(1,30),
                'tag_id' => rand(1,30),

            ];
            DB::table('taggables')->insert($taggable);
        }
    }
}
