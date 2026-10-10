<?php

namespace Database\Seeders;

use App\Models\Ptj;
use Illuminate\Database\Seeder;

class PtjSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 8) as $i) {
            Ptj::firstOrCreate(['name' => "PTJ Contoh $i"]);
        }
    }
}