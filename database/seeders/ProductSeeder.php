<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('products')->insert([
                [
                    "name"=> "Schneider Asfora Beyaz Komütatör",
                    "category_id"=> 1,
                    "price"=> "120.75",
                    "stock"=> 10
                ],
                [
                    "name" => "Reko Mini Tamir Hassas Tornavida Seti 32'li",
                    "category_id"=> 1,
                    "price"=> "49.50",
                    "stock"=> 10
                ],
                [
                    "name"=> "Viko Karre Anahtar - Beyaz",
                    "category_id"=> 2,
                    "price"=> "11.28",
                    "stock"=> 10
                ],
                [
                    "name"=> "Legrand Salbei Anahtar, Alüminyum",
                    "category_id"=> 2,
                    "price"=> "22.80",
                    "stock"=> 10
                ],
                [
                    "name"=> "Cırcırlı Tornavida Seti",
                    "category_id"=> 3,
                    "price"=> "12.95",
                    "stock"=> 16
                ],
                [
                    "name"=> "Black&Decker A7062 40 Parça Cırcırlı Tornavida Seti",
                    "category_id"=> 3,
                    "price"=> "12.95",
                    "stock"=> 0
                ]
        ]);

    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
