<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        Product::create([
            'name_en' => 'TestProduct1',
            'name_ar' => 'منتج اختبار 1',
            'price'=> 120.00,
            'quantity'=> 5,
            'slug'=> 'test-product-1',
            'category_id' => 1,
            'seller_id' => 1,
        ]);

        Product::create([
            'name_en' => 'TestProduct2',
            'name_ar' => 'منتج اختبار 2',
            'price'=> 220.00,
            'quantity'=> 3,
            'slug'=> 'test-product-2',
            'category_id' => 1,
            'seller_id' => 1,
        ]);


        Product::create([
            'name_en' => 'TestProduct3',
            'name_ar' => 'منتج اختبار 3',
            'price'=> 350.00,
            'quantity'=> 10,
            'slug'=> 'test-product-3',
            'category_id' => 1,
            'seller_id' => 1,
        ]);
    }
}
