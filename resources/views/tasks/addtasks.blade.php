
@extends('layouts.fo')

@section('content')
    <h1>Adicionar Tasks</h1>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome da tarefa</label>
            <input required type="text" name="name" class="form-control" id="name">
        </div>
        @error('name')
            <p>Nome da tarefa inválido</p>
        @enderror

        <div class="mb-3">
            <label for="due_at" class="form-label">Data de conclusão</label>
            <input required type="date" name="due_at" class="form-control" id="due_at">
        </div>
        @error('due_at')
            <p>Data inválida</p>
        @enderror

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select required name="status" class="form-select" id="status">
                <option value="0">Pendente</option>
                <option value="1">Concluída</option>
            </select>
        </div>
        @error('status')
            <p>Estado inválido</p>
        @enderror

        <div class="mb-3">
            <label for="user_id" class="form-label">Responsável</label>
            <select required name="user_id" class="form-select" id="user_id">
                <option value="">Selecionar responsável</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('user_id')
            <p>Responsável inválido</p>
        @enderror

        <button type="submit" class="btn btn-primary">
            Adicionar tarefa
        </button>
    </form>
@endsection
