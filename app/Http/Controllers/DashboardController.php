<?php

namespace App\Http\Controllers;

use App\Models\Kri;
use App\Models\Ptj;
use App\Models\RiskRegister;
use App\Models\SubKri;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'totalRisks' => RiskRegister::count(),
            'highImpactRisks' => RiskRegister::where(
                'is_high_impact',
                true
            )->count(),
            'totalKris' => Kri::count(),
            'totalSubKris' => SubKri::count(),
            'totalPtjs' => Ptj::count(),
        ];

        $recentRisks = RiskRegister::with('ptj')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'recentRisks'));
    }
}
