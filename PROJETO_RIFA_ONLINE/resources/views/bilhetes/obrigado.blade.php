@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <img src="{{ asset('storage/' . $rifa->imagem_premio) }}" class="card-img-top" alt="{{ $rifa->titulo }}">
            <div class="card-body">
                <h1 class="card-title">{{ $rifa->titulo }}</h1>
                <p class="card-text">{{ $rifa->descricao }}</p>
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
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Comprar Bilhetes</h3>
            </div>
            <div class="card-body">
                @auth
                    <form method="POST" action="{{ route('bilhetes.comprar', $rifa) }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="numeros" class="form-label">Selecione os números</label>
                            <select name="numeros[]" id="numeros" class="form-select" multiple size="10" required>
                                @foreach($numerosDisponiveis as $numero)
                                    <option value="{{ $numero }}">{{ $numero }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Segure Ctrl para selecionar múltiplos números</small>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-shopping-cart me-2"></i> Comprar Selecionados
                        </button>
                    </form>
                @else
                    <div class="alert alert-warning">
                        <p>Você precisa estar logado para comprar bilhetes.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-secondary">Cadastre-se</a>
                    </div>
                @endauth
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0">Bilhetes Vendidos</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Comprador</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bilhetesComprados as $bilhete)
                            <tr>
                                <td>{{ $bilhete->numero }}</td>
                                <td>{{ $bilhete->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection