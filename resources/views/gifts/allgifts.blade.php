@extends('layouts.fo')

@section('content')
    <button onclick="history.back()" class="btn btn-secondary">
        Voltar
    </button>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h1 class="display-5">Prendas de Natal 🎁🎁</h1>
    <section class="container">
        <div class="text-end">
            <a href="{{ route('gifts.add') }}">
                <button class=" btn btn-info"> Adicionar</button>
            </a>
        </div>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Pessoa</th>
                    <th scope="col">Valor Previsto</th>
                    <th scope="col">Valor Gasto</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($giftsFromDB as $gift)
                    <tr>
                        <th scope="row">{{ $gift->id }}</th>
                        <td>{{ $gift->gift_name }}</td>
                        <td>{{ $gift->responsavel }}</td>
                        <td>{{ $gift->expected_value }}</td>
                        <td>{{ $gift->actual_value }}</td>
                        <td>
                            @if ($gift->actual_value === null)
                                <span class="text-muted">Por calcular</span>
                            @else
                                @php
                                    $difference = $gift->actual_value - $gift->expected_value;
                                @endphp

                                @if ($difference > 0)
                                    <span class="text-danger">
                                        +{{ number_format($difference, 2, ',', '.') }} €
                                    </span>
                                @elseif ($difference < 0)
                                    <span class="text-success">
                                        {{ number_format($difference, 2, ',', '.') }} €
                                    </span>
                                @else
                                    <span class="text-muted">0,00 €</span>
                                @endif
                            @endif
                        </td>
                        <td><a href="{{ route('gifts.delete', $gift->id) }}" class="btn btn-danger">Apagar</a></td>
                        <td><a href="{{ route('gifts.edit', $gift->id) }}" class="btn btn-info">Ver</a></td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>
@endsection
