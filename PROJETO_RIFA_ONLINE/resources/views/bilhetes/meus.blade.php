@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Meus Bilhetes</h1>
        
        @if($bilhetes->isEmpty())
            <div class="alert alert-info">
                Você ainda não comprou nenhum bilhete.
                <a href="{{ route('home') }}" class="alert-link">Veja as rifas disponíveis</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Rifa</th>
                            <th>Número</th>
                            <th>Status</th>
                            <th>Data da Compra</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bilhetes as $bilhete)
                        <tr>
                            <td>{{ $bilhete->rifa->titulo }}</td>
                            <td>{{ $bilhete->numero }}</td>
                            <td>
                                @if($bilhete->status === 'pago')
                                    <span class="badge bg-success">Pago</span>
                                @elseif($bilhete->status === 'sorteado')
                                    <span class="badge bg-primary">Sorteado</span>
                                @else
                                    <span class="badge bg-warning text-dark">Reservado</span>
                                @endif
                            </td>
                            <td>{{ $bilhete->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('rifas.show', $bilhete->rifa) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
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
@endsection