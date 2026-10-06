@extends('layouts.app')

@section('title', 'Editar cliente')

@section('content')
    <div class="card">
        <h1>Editar cliente</h1>

        <form method="POST" action="{{ route('clients.update', $client) }}">
            @csrf
            @method('PUT')
            @include('clients._form', ['client' => $client])

            <div class="actions">
                <button class="btn" type="submit">Actualizar</button>
                <a class="btn btn-secondary" href="{{ route('clients.show', $client) }}">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
