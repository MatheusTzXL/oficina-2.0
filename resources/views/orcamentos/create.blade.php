@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Novo Orçamento</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('orcamentos.store') }}">
        @csrf

        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <input type="text" name="cliente" class="form-control" value="{{ old('cliente') }}" required>
        </div>

        <div class="mb-3">
            <label for="data_hora" class="form-label">Data e Hora</label>
            <input type="datetime-local" name="data_hora" class="form-control" value="{{ old('data_hora') }}" required>
        </div>

        <div class="mb-3">
            <label for="vendedor" class="form-label">Vendedor</label>
            <input type="text" name="vendedor" class="form-control" value="{{ old('vendedor') }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" required>{{ old('descricao') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor (R$)</label>
            <input type="number" name="valor" class="form-control" step="0.01" value="{{ old('valor') }}" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
        
    </form>
@endsection
