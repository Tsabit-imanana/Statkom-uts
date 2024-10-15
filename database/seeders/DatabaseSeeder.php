<?php

namespace Database\Seeders;
use App\Models\Data;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Lokasi file CSV
        $csvFile = fopen(base_path("database/data/data.csv"), "r");

        // Lewati header
        $firstLine = true;

        // Hitung berapa data yang sudah dimasukkan
        $count = 0;

        // Baca CSV baris per baris
        while (($data = fgetcsv($csvFile, 0, ";")) !== FALSE) {
            if (!$firstLine && $count < 5000) {
                // Hapus titik dari nilai 'Total' dan ubah ke angka float
                $totalValue = floatval(str_replace('.', '', $data[15]));
                $count++;
                // Cek apakah nilai Total >= 1000
                if ($totalValue >= 1000) {
                    // Masukkan data ke dalam tabel jika nilai 'Total' >= 1000
                    Data::create([
                        'id_first_major' => $data[1],
                        'id_first_university' => $data[2],
                        'id_second_major' => $data[3],
                        'id_second_university' => $data[4],
                        'id_user' => $data[5],
                        'score_eko' => $data[6],
                        'score_geo' => $data[7],
                        'score_kmb' => $data[8],
                        'score_kpu' => $data[9],
                        'score_kua' => $data[10],
                        'score_mat' => $data[11],
                        'score_ppu' => $data[12],
                        'score_sej' => $data[13],
                        'score_sos' => $data[14],
                        'total' => $totalValue,
                        'keterangan' => $data[16],
                    ]);

                    
                }
            }
            $firstLine = false;
        }

        // Tutup file CSV
        fclose($csvFile);
    }
}
