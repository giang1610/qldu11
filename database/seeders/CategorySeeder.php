<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tạo lần lượt các bảng ghi đưa vào bảng
        DB::table('categories')->insert([
            'name'=> fake()->name(), // dùng fake để tạo dữ liệu ngẫu nhiên
            // 'name'=> 'abc' // tên chỉ định
            // 'status'=> fake()->numberBetween(0,1)
        ]);
        $categorySeeder = [];
        for($i=0; $i< 10; $i++){
            $categorySeeder[] = [
            'name'=>fake()->name()
            ];
        }
        DB::table('categories')->insert($categorySeeder);
    }
}
