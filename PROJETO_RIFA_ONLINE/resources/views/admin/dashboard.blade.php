@extends('layouts.admin')

@section('title', 'Dashboard')

@section('admin-content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Rifas Cadastradas</h5>
                <p class="card-text display-4">{{ $totalRifas }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Bilhetes Vendidos</h5>
                <p class="card-text display-4">{{ $totalVendidos }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Total Arrecadado</h5>
                <p class="card-text display-4">R$ {{ number_format($totalArrecadado, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Total Bilhetes</h5>
                <p class="card-text display-4">{{ $totalBilhetes }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Rifas Ativas
            </div>
            <div class="card-body">
                @if($rifasAtivas->isEmpty())
                    <p class="mb-0">Nenhuma rifa ativa no momento.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Bilhetes</th>
                                    <th>Sorteio</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rifasAtivas as $rifa)
                                <tr>
                                    <td>{{ $rifa->titulo }}</td>
                                    <td>{{ $rifa->bilhetes_disponiveis }} / {{ $rifa->quantidade_bilhetes }}</td>
                                    <td>{{ $rifa->data_sorteio->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.rifas.edit', $rifa) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.sorteio.form', $rifa) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-random"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Rifas Encerradas/Sorteadas
            </div>
            <div class="card-body">
                @if($rifasEncerradas->isEmpty() && $rifasSorteadas->isEmpty())
                    <p class="mb-0">Nenhuma rifa encerrada ou sorteada.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Status</th>
                                    <th>Sorteio</th>
                                    <th>Vencedor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rifasEncerradas as $rifa)
                                <tr>
                                    <td>{{ $rifa->titulo }}</td>
                                    <td><span class="badge bg-secondary">Encerrada</span></td>
                                    <td>{{ $rifa->data_sorteio->format('d/m/Y H:i') }}</td>
                                    <td>-</td>
                                </tr>
                                @endforeach
                                
                                @foreach($rifasSorteadas as $rifa)
                                <tr>
                                    <td>{{ $rifa->titulo }}</td>
                                    <td><span class="badge bg-success">Sorteada</span></td>
                                    <td>{{ $rifa->data_sorteio->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @php
                                            $vencedor = $rifa->bilhetes()->where('status', 'sorteado')->first();
                                        @endphp
                                        @if($vencedor)
                                            Bilhete #{{ $vencedor->numero }} ({{ $vencedor->user->name }})
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection