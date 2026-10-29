<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Seed the application's laboratory equipments.
     */
    public function run(): void
    {
        $now = now();

        $categoryIds = DB::table('categories')->pluck('id', 'code');

        $equipments = [
            [
                'category_code' => 'SRV',
                'asset_code' => 'EQ-SRV-001',
                'name' => 'Server A',
                'specification' => 'spesifikasi bagus.',
                'condition' => 'baik',
                'status' => 'tersedia',
                'daily_rental_fee' => 250000,
                'image_path' => null,
            ],
            [
                'category_code' => 'SRV',
                'asset_code' => 'EQ-SRV-002',
                'name' => 'Server B',
                'specification' => 'Spesifikasi bagus.',
                'condition' => 'rusak_ringan',
                'status' => 'dalam_perbaikan',
                'daily_rental_fee' => 225000,
                'image_path' => null,
            ],
            [
                'category_code' => 'IOT',
                'asset_code' => 'EQ-IOT-001',
                'name' => 'IOT A',
                'specification' => 'Bagus untuk pemula.',
                'condition' => 'baik',
                'status' => 'tersedia',
                'daily_rental_fee' => 45000,
                'image_path' => null,
            ],
            [
                'category_code' => 'IOT',
                'asset_code' => 'EQ-IOT-002',
                'name' => 'IOT B',
                'specification' => 'Bagus untuk pemula.',
                'condition' => 'rusak_ringan',
                'status' => 'dipinjam',
                'daily_rental_fee' => 25000,
                'image_path' => null,
            ],
            [
                'category_code' => 'IOT',
                'asset_code' => 'EQ-IOT-005',
                'name' => 'Raspberry Pi 4 Model B (8GB RAM) Starter Kit',
                'specification' => 'Quad-core Cortex-A72 @1.5GHz, 8GB LPDDR4, MicroSD 64GB Class 10, Casing
Alumunium Aktif Fan, Power Supply Type-C Resmi',
                'condition' => 'baik',
                'status' => 'tersedia',
                'daily_rental_fee' => 15000,
                'image_path' => null,
            ],
            [
                'category_code' => 'DRN',
                'asset_code' => 'EQ-DRN-001',
                'name' => 'Drone A',
                'specification' => 'Sensor bagus.',
                'condition' => 'baik',
                'status' => 'tersedia',
                'daily_rental_fee' => 350000,
                'image_path' => null,
            ],
            [
                'category_code' => 'DRN',
                'asset_code' => 'EQ-DRN-002',
                'name' => 'Drone B',
                'specification' => 'Sensor bagus.',
                'condition' => 'rusak_berat',
                'status' => 'dalam_perbaikan',
                'daily_rental_fee' => 300000,
                'image_path' => null,
            ],
            [
                'category_code' => 'DRN',
                'asset_code' => 'EQ-DRN-003',
                'name' => 'Drone C',
                'specification' => 'Sensor bagus.',
                'condition' => 'baik',
                'status' => 'dipinjam',
                'daily_rental_fee' => 275000,
                'image_path' => null,
            ],
        ];

        $rows = array_map(fn (array $equipment) => [
            'category_id' => $categoryIds[$equipment['category_code']],
            'asset_code' => $equipment['asset_code'],
            'name' => $equipment['name'],
            'specification' => $equipment['specification'],
            'condition' => $equipment['condition'],
            'status' => $equipment['status'],
            'daily_rental_fee' => $equipment['daily_rental_fee'],
            'image_path' => $equipment['image_path'],
            'created_at' => $now,
            'updated_at' => $now,
        ], $equipments);

        DB::table('equipments')->upsert(
            $rows,
            ['asset_code'],
            ['category_id', 'name', 'specification', 'condition', 'status', 'daily_rental_fee', 'image_path', 'updated_at']
        );
    }
}
