<?php

namespace Database\Seeders;

use App\Models\KriApproval;
use App\Models\RiskRegister;
use App\Models\SubKri;
use App\Models\User;
use Illuminate\Database\Seeder;

class RiskRegisterSeeder extends Seeder
{
    public function run(): void
    {
        RiskRegister::factory()->count(60)->create();

        $subKris = SubKri::all();
        $adminId = User::where('role', 'admin')->value('id');
        $lpuId   = User::where('role', 'lpu')->value('id');

        // Mark 20 risks as high-impact and assign a random Sub-KRI
        RiskRegister::inRandomOrder()->take(20)->get()->each(function ($risk) use ($subKris, $adminId, $lpuId) {
            $sub    = $subKris->random();
            $status = collect(['pending', 'approved', 'rejected'])->random();

            $risk->update([
                'is_high_impact'     => true,
                'high_impact_set_by' => $adminId,
                'high_impact_set_at' => now(),
                'kri_id'             => $sub->kri_id,
                'sub_kri_id'         => $sub->id,
            ]);

            KriApproval::create([
                'risk_register_id' => $risk->id,
                'kri_id'           => $sub->kri_id,
                'sub_kri_id'       => $sub->id,
                'submitted_by'     => $adminId,
                'reviewed_by'      => $status === 'pending' ? null : $lpuId,
                'status'           => $status,
                'submitted_at'     => now(),
                'reviewed_at'      => $status === 'pending' ? null : now(),
            ]);
        });
    }
}