<?php

namespace Database\Factories;

use App\Models\Ptj;
use Illuminate\Database\Eloquent\Factories\Factory;

class RiskRegisterFactory extends Factory
{
    public function definition(): array
    {
        $scores = [
            'human_impact'       => fake()->numberBetween(1, 5),
            'reputation_impact'  => fake()->numberBetween(1, 5),
            'financial_impact'   => fake()->numberBetween(1, 5),
            'operational_impact' => fake()->numberBetween(1, 5),
            'objective_impact'   => fake()->numberBetween(1, 5),
        ];
        $likelihood = fake()->numberBetween(1, 5);
        $average    = round(array_sum($scores) / 5, 2);
        $index      = round($likelihood * $average, 2);

        return array_merge($scores, [
            'ptj_id'            => Ptj::inRandomOrder()->value('id'),
            'year'              => 2025,
            'risk_description'  => 'Contoh keterangan risiko ' . fake()->unique()->numberBetween(1, 9999),
            'risk_owner'        => 'PEMILIK CONTOH ' . fake()->randomElement(['A', 'B', 'C', 'D']),
            'registered_date'   => fake()->dateTimeBetween('-1 year', '-6 months'),
            'updated_date'      => fake()->dateTimeBetween('-6 months', 'now'),
            'likelihood'        => $likelihood,
            'average_score'     => $average,
            'risk_index'        => $index,
            // PLACEHOLDER bands, replace with the real ones later
            'risk_level'        => $index >= 8 ? 'TINGGI' : ($index >= 4 ? 'SEDERHANA' : 'RENDAH'),
            'existing_controls' => 'Contoh kawalan sedia ada',
            'proposed_controls' => 'Contoh kawalan tambahan',
            'status'            => fake()->randomElement(['Menunggu Tindakan PTJ', 'Dalam Pemantauan', 'Selesai']),
            'category'          => fake()->randomElement(['Operasi', 'Strategik', 'Kewangan', 'Pematuhan']),
            'marker'            => fake()->randomElement(['Baharu', null]),
            'classification'    => fake()->randomElement(['Institusi', 'PTJ']),
            'import_hash'       => hash('sha256', fake()->unique()->uuid()),
        ]);
    }
}