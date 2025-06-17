@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Rifas Disponíveis</h1>
    </div>
</div>

<div class="row">
    @foreach($rifas as $rifa)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="{{ asset('storage/' . $rifa->imagem_premio) }}" class="card-img-top" alt="{{ $rifa->titulo }}">
            <div class="card-body">
                <h5 class="card-title">{{ $rifa->titulo }}</h5>
                <p class="card-text">{{ Str::limit($rifa->descricao, 100) }}</p>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item">
                        <strong>Preço do bilhete:</strong> R$ {{ number_format($rifa->preco_bilhete, 2, ',', '.') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Bilhetes disponíveis:</strong> {{ $rifa->bilhetes_disponiveis }} / {{ $rifa->quantidade_bilhetes }}
                    </li>
                    <li class="list-group-item">
                        <strong>Data do sorteio:</strong> {{ $rifa->data_sorteio->format('d/m/Y H:i') }}
                    </li>
                </ul>
                <a href="{{ route('rifas.show', $rifa) }}" class="btn btn-primary w-100">Comprar Bilhetes</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection