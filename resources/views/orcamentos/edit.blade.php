@extends('layouts.app')

@section('title', 'Editar Orçamento')
@section('header', 'Editar Orçamento')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('orcamentos.update', $orcamento) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <input type="text" name="cliente" class="form-control" value="{{ old('cliente', $orcamento->cliente) }}" required>
        </div>

        <div class="mb-3">
            <label for="data_hora" class="form-label">Data e Hora</label>
            <input type="datetime-local" name="data_hora" class="form-control" value="{{ old('data_hora', \Carbon\Carbon::parse($orcamento->data_hora)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="vendedor" class="form-label">Vendedor</label>
            <input type="text" name="vendedor" class="form-control" value="{{ old('vendedor', $orcamento->vendedor) }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" required>{{ old('descricao', $orcamento->descricao) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor (R$)</label>
            <input type="number" name="valor" class="form-control" step="0.01" value="{{ old('valor', $orcamento->valor) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
