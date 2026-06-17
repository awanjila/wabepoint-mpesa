<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Industry Insights', 'slug' => 'industry-insights', 'meta_title' => 'Industry Insights - WabePoint Blog', 'category_description' => 'Trends and insights across retail industries'],
            ['category_name' => 'Product Updates', 'slug' => 'product-updates', 'meta_title' => 'Product Updates - WabePoint Blog', 'category_description' => 'New features and improvements to WabePoint'],
            ['category_name' => 'Guides & Tutorials', 'slug' => 'guides-tutorials', 'meta_title' => 'Guides & Tutorials - WabePoint Blog', 'category_description' => 'Step-by-step guides for using WabePoint'],
            ['category_name' => 'Customer Stories', 'slug' => 'customer-stories', 'meta_title' => 'Customer Stories - WabePoint Blog', 'category_description' => 'Success stories from WabePoint customers'],
            ['category_name' => 'Business Tips', 'slug' => 'business-tips', 'meta_title' => 'Business Tips - WabePoint Blog', 'category_description' => 'Tips to grow and manage your business'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert($cat);
        }
    }
}
