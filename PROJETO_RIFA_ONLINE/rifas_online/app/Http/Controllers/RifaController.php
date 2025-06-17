<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use Illuminate\Http\Request;

class RifaController extends Controller
{
    public function index()
    {
        $rifas = Rifa::where('status', 'ativa')->latest()->get();
        return view('rifas.index', compact('rifas'));
    }

    public function show(Rifa $rifa)
    {
        $numerosDisponiveis = $rifa->numerosDisponiveis();
        $bilhetesComprados = $rifa->bilhetesComprados()->with('user')->get();
        
        return view('rifas.show', compact('rifa', 'numerosDisponiveis', 'bilhetesComprados'));
    }
}