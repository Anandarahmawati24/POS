<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Stok untuk barang dari Supplier 1 (PT. Sumber Jaya)
            ['stok_id' => 1, 'supplier_id' => 1, 'barang_id' => 1, 'user_id' => 1, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 50, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 2, 'supplier_id' => 1, 'barang_id' => 2, 'user_id' => 1, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 40, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 3, 'supplier_id' => 1, 'barang_id' => 3, 'user_id' => 1, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 30, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 4, 'supplier_id' => 1, 'barang_id' => 4, 'user_id' => 1, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 25, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 5, 'supplier_id' => 1, 'barang_id' => 5, 'user_id' => 1, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 20, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],

            // Stok untuk barang dari Supplier 2 (CV. Makmur Sentosa)
            ['stok_id' => 6, 'supplier_id' => 2, 'barang_id' => 6, 'user_id' => 2, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 80, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 7, 'supplier_id' => 2, 'barang_id' => 7, 'user_id' => 2, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 70, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 8, 'supplier_id' => 2, 'barang_id' => 8, 'user_id' => 2, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 60, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 9, 'supplier_id' => 2, 'barang_id' => 9, 'user_id' => 2, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 50, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 10, 'supplier_id' => 2, 'barang_id' => 10, 'user_id' => 2, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 40, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],

            // Stok untuk barang dari Supplier 3 (UD. Sukses Abadi)
            ['stok_id' => 11, 'supplier_id' => 3, 'barang_id' => 11, 'user_id' => 3, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 100, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 12, 'supplier_id' => 3, 'barang_id' => 12, 'user_id' => 3, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 90, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 13, 'supplier_id' => 3, 'barang_id' => 13, 'user_id' => 3, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 80, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 14, 'supplier_id' => 3, 'barang_id' => 14, 'user_id' => 3, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 70, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
            ['stok_id' => 15, 'supplier_id' => 3, 'barang_id' => 15, 'user_id' => 3, 'stok_tanggal' => '2025-03-09 17:32:54', 'stok_jumlah' => 60, 'created_at' => '2025-03-09 10:32:54', 'updated_at' => NULL],
        ];

        DB::table('t_stok')->insert($data);
    }
}
