@extends('layouts.fo')

@section('content')
    <h6>Detalhes da tarefa: {{ $taskInfo->name }}</h6>

    <ul>
        <p>Nome - {{ $taskInfo->name }}</p>
        <p>Descrição - {{ $taskInfo->description }}</p>
        <p>Data limite - {{ $taskInfo->due_at }}</p>
        <p>Estado - {{ $taskInfo->status ? 'Concluída' : 'Pendente' }}</p>
        <p>Responsavel - {{ $taskInfo->responsavel}}</p>
    </ul>

    
@endsection
