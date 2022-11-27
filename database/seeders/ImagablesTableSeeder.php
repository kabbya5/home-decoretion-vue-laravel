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
        $type = ['App\Model\Product','App\Model\Tag'];

        for($i = 0; $i<80;$i++){
            $imagable = [
                'imagables_type' => $type[rand(0,1)],
                'imagables_id' => rand(1,50),
            ];
            DB::table('imagables')->insert($imagable);
        }
    }
}
