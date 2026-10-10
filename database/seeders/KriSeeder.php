<?php

namespace Database\Seeders;

use App\Models\Kri;
use App\Models\SubKri;
use Illuminate\Database\Seeder;

class KriSeeder extends Seeder
{
    public function run(): void
    {
        $handle = fopen(database_path('seeders/data/kri_catalogue.csv'), 'r');
        fgetcsv($handle); // skip header row

        while (($row = fgetcsv($handle)) !== false) {
            [$num, $kriName, $kriDesc, $code, $subName, $subDesc] = $row;

            $kri = Kri::firstOrCreate(
                ['number' => (int) $num],
                ['name' => $kriName, 'description' => $kriDesc]
            );

            SubKri::firstOrCreate(
                ['code' => $code],
                ['kri_id' => $kri->id, 'name' => $subName, 'description' => $subDesc]
            );
        }

        fclose($handle);
    }
}