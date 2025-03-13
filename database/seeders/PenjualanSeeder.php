<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Andi',
                'penjualan_kode' => 'TRX001',
                'penjualan_tanggal' => '2025-03-09 17:32:54',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 2,
                'pembeli' => 'Budi',
                'penjualan_kode' => 'TRX002',
                'penjualan_tanggal' => '2025-03-09 17:32:54',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Citra',
                'penjualan_kode' => 'TRX003',
                'penjualan_tanggal' => '2025-03-09 17:32:54',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 1,
                'pembeli' => 'Dewi',
                'penjualan_kode' => 'TRX004',
                'penjualan_tanggal' => '2025-03-09 18:00:00',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Eko',
                'penjualan_kode' => 'TRX005',
                'penjualan_tanggal' => '2025-03-09 18:05:30',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Fajar',
                'penjualan_kode' => 'TRX006',
                'penjualan_tanggal' => '2025-03-09 18:10:45',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Gita',
                'penjualan_kode' => 'TRX007',
                'penjualan_tanggal' => '2025-03-09 18:15:20',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 2,
                'pembeli' => 'Hadi',
                'penjualan_kode' => 'TRX008',
                'penjualan_tanggal' => '2025-03-09 18:20:10',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Indah',
                'penjualan_kode' => 'TRX009',
                'penjualan_tanggal' => '2025-03-09 18:25:55',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 1,
                'pembeli' => 'Joko',
                'penjualan_kode' => 'TRX010',
                'penjualan_tanggal' => '2025-03-09 18:30:40',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
