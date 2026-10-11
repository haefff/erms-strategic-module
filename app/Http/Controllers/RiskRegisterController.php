<?php

namespace App\Http\Controllers;

use App\Models\RiskRegister;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RiskRegisterController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());

        $risks = RiskRegister::with('ptj')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('risk_number', 'like', "%{$search}%")
                      ->orWhere('risk_description', 'like', "%{$search}%")
                      ->orWhere('risk_owner', 'like', "%{$search}%")
                      ->orWhereHas('ptj', function ($ptjQuery) use ($search) {
                          $ptjQuery->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('risks.index', compact('risks', 'search'));
    }
}
