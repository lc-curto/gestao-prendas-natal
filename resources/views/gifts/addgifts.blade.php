@extends('layouts.fo')

@section('content')
    <button onclick="history.back()" class="btn btn-secondary">
        Voltar
    </button>
    <h6 class="display-5">Adicionar Prenda</h6>

    <form method="POST" action="{{ route('gifts.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome da prenda</label>
            <input required type="text" name="gift_name" class="form-control">
        </div>

        @error('gift_name')
            <p>Nome da prenda inválido</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Pessoa</label>
            <select name="user_id" class="form-select" required>
                <option value="">Selecionar pessoa</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @error('user_id')
            <p>Utilizador inválido</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Valor previsto (€)</label>
            <input required type="number" step="0.01" min="0" name="expected_value" class="form-control">
        </div>

        @error('expected_value')
            <p>Valor previsto inválido</p>
        @enderror

        <div class="mb-3">
            <label class="form-label">Valor gasto (€)</label>
            <input type="number" step="0.01" min="0" name="actual_value" class="form-control">
        </div>

        @error('actual_value')
            <p>Valor gasto inválido</p>
        @enderror

        <button type="submit" class="btn btn-primary">Adicionar</button>

        <a href="{{ route('gifts.all') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
