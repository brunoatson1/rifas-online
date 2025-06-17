@extends('layouts.admin')

@section('title', 'Gerenciar Rifas')

@section('actions')
    <a href="{{ route('admin.rifas.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Nova Rifa
    </a>
@endsection

@section('admin-content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Preço</th>
                        <th>Bilhetes</th>
                        <th>Sorteio</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rifas as $rifa)
                    <tr>
                        <td>{{ $rifa->titulo }}</td>
                        <td>R$ {{ number_format($rifa->preco_bilhete, 2, ',', '.') }}</td>
                        <td>{{ $rifa->bilhetes_disponiveis }} / {{ $rifa->quantidade_bilhetes }}</td>
                        <td>{{ $rifa->data_sorteio->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($rifa->status === 'ativa')
                                <span class="badge bg-success">Ativa</span>
                            @elseif($rifa->status === 'encerrada')
                                <span class="badge bg-secondary">Encerrada</span>
                            @else
                                <span class="badge bg-primary">Sorteada</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.rifas.edit', $rifa) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($rifa->status === 'ativa')
                                    <a href="{{ route('admin.sorteio.form', $rifa) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-random"></i>
                                    </a>
                                @endif
                                <form action="{{ route('admin.rifas.destroy', $rifa) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta rifa?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection