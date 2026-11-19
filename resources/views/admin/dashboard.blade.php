@extends('layouts.fo')

@section('content')
    <button onclick="history.back()" class="btn btn-secondary">
        Voltar
    </button>
    <h6>Olá {{ Auth::user()->name }} voce é Admin</h6>
@endsection
