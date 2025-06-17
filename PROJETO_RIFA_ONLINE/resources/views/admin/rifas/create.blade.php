@extends('layouts.admin')

@section('title', isset($rifa) ? 'Editar Rifa' : 'Criar Rifa')

@section('admin-content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($rifa) ? route('admin.rifas.update', $rifa) : route('admin.rifas.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($rifa))
                @method('PUT')
            @endif
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título da Rifa</label>
                <input type="text" class="form-control" id="titulo" name="titulo" 
                       value="{{ old('titulo', $rifa->titulo ?? '') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required>{{ old('descricao', $rifa->descricao ?? '') }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="preco_bilhete" class="form-label">Preço do Bilhete (R$)</label>
                    <input type="number" step="0.01" class="form-control" id="preco_bilhete" name="preco_bilhete" 
                           value="{{ old('preco_bilhete', $rifa->preco_bilhete ?? '') }}" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="quantidade_bilhetes" class="form-label">Quantidade de Bilhetes</label>
                    <input type="number" class="form-control" id="quantidade_bilhetes" name="quantidade_bilhetes" 
                           value="{{ old('quantidade_bilhetes', $rifa->quantidade_bilhetes ?? '') }}" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="data_sorteio" class="form-label">Data do Sorteio</label>
                    <input type="datetime-local" class="form-control" id="data_sorteio" name="data_sorteio" 
                           value="{{ old('data_sorteio', isset($rifa) ? $rifa->data_sorteio->format('Y-m-d\TH:i') : '') }}" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="imagem_premio" class="form-label">Imagem do Prêmio</label>
                <input type="file" class="form-control" id="imagem_premio" name="imagem_premio" 
                       {{ !isset($rifa) ? 'required' : '' }}>
                @if(isset($rifa) && $rifa->imagem_premio)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $rifa->imagem_premio) }}" alt="Imagem atual" style="max-height: 150px;">
                    </div>
                @endif
            </div>
            
            <button type="submit" class="btn btn-primary">
                {{ isset($rifa) ? 'Atualizar Rifa' : 'Criar Rifa' }}
            </button>
            <a href="{{ route('admin.rifas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection