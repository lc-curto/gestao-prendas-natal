@extends('layouts.fo')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
    </div>
    @endif
    <h6>Tarefas</h6>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Data de Conclusão</th>
                <th scope="col">Status</th>
                <th scope="col">Responsavel</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasksFromDB as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->due_at }}</td>
                    <td>{{ $task->status == 0 ? 'Pendente' : 'Concluída' }}</td>
                    <td>{{ $task->responsavel }}</td>
                    <td><a href="{{ route('tasks.delete', $task->id) }}" class="btn btn-danger">Apagar</a></td>
                    <td><a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info">Ver</a></td>

                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
