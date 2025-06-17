<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\Rifa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

class BilheteController extends Controller
{
    public function comprar(Request $request, Rifa $rifa)
    {
        $request->validate([
            'numeros' => 'required|array',
            'numeros.*' => 'integer|min:1|max:'.$rifa->quantidade_bilhetes,
        ]);

        // Verifica se os números estão disponíveis
        $numerosDisponiveis = $rifa->numerosDisponiveis();
        foreach ($request->numeros as $numero) {
            if (!in_array($numero, $numerosDisponiveis)) {
                return back()->with('error', 'O número '.$numero.' já foi vendido.');
            }
        }

        // Cria os bilhetes (status reservado)
        $bilhetes = [];
        foreach ($request->numeros as $numero) {
            $bilhetes[] = Bilhete::create([
                'rifa_id' => $rifa->id,
                'user_id' => Auth::id(),
                'numero' => $numero,
                'status' => 'reservado',
            ]);
        }

        // Configura Mercado Pago
        SDK::setAccessToken(config('services.mercadopago.access_token'));

        // Cria a preferência de pagamento
        $preference = new Preference();

        // Cria itens para cada bilhete
        $items = [];
        foreach ($bilhetes as $bilhete) {
            $item = new Item();
            $item->title = "Bilhete #{$bilhete->numero} - {$rifa->titulo}";
            $item->quantity = 1;
            $item->unit_price = $rifa->preco_bilhete;
            $items[] = $item;
        }

        $preference->items = $items;
        $preference->external_reference = $bilhetes[0]->codigo;
        $preference->back_urls = [
            'success' => route('bilhetes.obrigado', $bilhetes[0]),
            'failure' => url('/'),
            'pending' => url('/'),
        ];
        $preference->auto_return = 'approved';
        $preference->save();

        // Atualiza os bilhetes com o transaction_id
        foreach ($bilhetes as $bilhete) {
            $bilhete->update([
                'transaction_id' => $preference->id,
            ]);
        }

        return redirect($preference->init_point);
    }

    public function obrigado(Bilhete $bilhete)
    {
        // Verifica se o usuário é o dono do bilhete
        if ($bilhete->user_id !== auth()->id()) {
            abort(403);
        }

        // Atualiza status se o pagamento foi aprovado
        if (request('status') === 'approved') {
            $bilhete->update([
                'status' => 'pago',
                'payment_status' => 'approved',
            ]);
        }

        return view('bilhetes.obrigado', compact('bilhete'));
    }

    public function meusBilhetes()
    {
        $bilhetes = auth()->user()->bilhetes()->with('rifa')->get();
        return view('bilhetes.meus', compact('bilhetes'));
    }
}