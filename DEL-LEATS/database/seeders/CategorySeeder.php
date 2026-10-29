<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's categories.
     */
    public function run(): void
    {
        $now = now();

        $categories = [
            ['name' => 'Server & Cloud', 'code' => 'SRV'],
            ['name' => 'Internet of Things', 'code' => 'IOT'],
            ['name' => 'Multimedia & Drone', 'code' => 'DRN'],
        ];

        $rows = array_map(fn (array $category) => [
            'name' => $category['name'],
            'code' => $category['code'],
            'created_at' => $now,
            'updated_at' => $now,
        ], $categories);

        DB::table('categories')->upsert($rows, ['code'], ['name', 'updated_at']);
    }
}
