<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro Max',
                'details' => 'Apple flagship smartphone with A17 Pro chip and titanium design',
                'price' => 20499000,
                'category_name' => 'Electronics',
                'stock' => 45,
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'details' => 'Premium Android phone with AI features and S Pen',
                'price' => 18799000,
                'category_name' => 'Electronics',
                'stock' => 40,
            ],
            [
                'name' => 'MacBook Pro M3',
                'details' => 'Apple laptop powered by M3 chip for high performance',
                'price' => 33999000,
                'category_name' => 'Electronics',
                'stock' => 20,
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'details' => 'Industry-leading noise cancelling wireless headphones',
                'price' => 5999000,
                'category_name' => 'Electronics',
                'stock' => 55,
            ],
            [
                'name' => 'Uniqlo Oversized T-Shirt',
                'details' => 'Comfortable oversized cotton t-shirt for everyday wear',
                'price' => 199000,
                'category_name' => 'Clothing',
                'stock' => 120,
            ],
            [
                'name' => 'Nike Tech Fleece Hoodie',
                'details' => 'Lightweight and warm hoodie with modern athletic fit',
                'price' => 2199000,
                'category_name' => 'Clothing',
                'stock' => 60,
            ],
            [
                'name' => 'Levi’s 501 Original Jeans',
                'details' => 'Classic straight fit denim jeans',
                'price' => 1199000,
                'category_name' => 'Clothing',
                'stock' => 80,
            ],
            [
                'name' => 'Atomic Habits',
                'details' => 'Bestselling self-improvement book by James Clear',
                'price' => 299000,
                'category_name' => 'Books',
                'stock' => 150,
            ],
            [
                'name' => 'The Psychology of Money',
                'details' => 'Timeless lessons on wealth, greed, and happiness',
                'price' => 249000,
                'category_name' => 'Books',
                'stock' => 130,
            ],
            [
                'name' => 'Laravel 11 From Scratch',
                'details' => 'Comprehensive guide to building modern Laravel applications',
                'price' => 399000,
                'category_name' => 'Books',
                'stock' => 70,
            ],
        ];

        $categoryNames = array_values(array_unique(array_column($products, 'category_name')));

        $categoryIds = DB::table('product_categories')
            ->whereIn('name', $categoryNames)
            ->pluck('id', 'name');

        $now = now();
        $records = [];

        foreach ($products as $product) {
            $categoryName = $product['category_name'];

            if (! isset($categoryIds[$categoryName])) {
                throw new RuntimeException("Product category '{$categoryName}' was not found. Seed categories first.");
            }

            $records[] = [
                'name' => $product['name'],
                'details' => $product['details'],
                'price' => $product['price'],
                'category_id' => $categoryIds[$categoryName],
                'stock' => $product['stock'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('products')->insert($records);
    }
}
