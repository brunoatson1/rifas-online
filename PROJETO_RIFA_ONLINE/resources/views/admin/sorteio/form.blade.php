@extends('layouts.admin')

@section('title', 'Realizar Sorteio')

@section('admin-content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Realizar Sorteio</h3>
            </div>
            <div class="card-body">
                <h4>{{ $rifa->titulo }}</h4>
                <p>Total de bilhetes vendidos: {{ $bilhetesPagos->count() }}</p>
                
                <form method="POST" action="{{ route('admin.sorteio.realizar', $rifa) }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="numero_sorteado" class="form-label">Número Sorteado</label>
                        <input type="number" class="form-control" id="numero_sorteado" name="numero_sorteado" 
                               min="1" max="{{ $rifa->quantidade_bilhetes }}" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-random me-1"></i> Realizar Sorteio
                    </button>
                    <a href="{{ route('admin.rifas.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
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
                            @foreach($bilhetesPagos as $bilhete)
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