<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bilhete;
use App\Models\Rifa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRifas = Rifa::count();
        $totalBilhetes = Bilhete::count();
        $totalVendidos = Bilhete::where('status', 'pago')->count();
        $totalArrecadado = Bilhete::where('status', 'pago')->with('rifa')->get()->sum(function($bilhete) {
            return $bilhete->rifa->preco_bilhete;
        });

        $rifasAtivas = Rifa::where('status', 'ativa')->get();
        $rifasEncerradas = Rifa::where('status', 'encerrada')->get();
        $rifasSorteadas = Rifa::where('status', 'sorteada')->get();

        return view('admin.dashboard', compact(
            'totalRifas',
            'totalBilhetes',
            'totalVendidos',
            'totalArrecadado',
            'rifasAtivas',
            'rifasEncerradas',
            'rifasSorteadas'
        ));
    }
}