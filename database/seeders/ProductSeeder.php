<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // tạo ra một mảng chứa tất cả các mảng của category_id
    public function run(): void
    {
        $categoyID = DB::table('categories')->pluck('id')->toArray();
        $productSeeder = [];
        for($i=0; $i<10; $i++ ){
            $productSeeder[] = [
              'name'=>fake()->name(),
              'price'=>fake()->randomNumber(),
              'quantity'=>fake()->randomNumber(),
              'image'=>fake()->imageUrl(),
              'category_id'=>fake()->randomElement($categoyID),
              'status'=>fake()->numberBetween(0,1),

            ];
        }
        DB::table('products')->insert($productSeeder);
    }
}
