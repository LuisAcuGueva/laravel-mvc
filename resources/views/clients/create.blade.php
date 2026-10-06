@extends('layouts.app')

@section('title', 'Nuevo cliente')

@section('content')
    <div class="card">
        <h1>Nuevo cliente</h1>

        <form method="POST" action="{{ route('clients.store') }}">
            @csrf
            @include('clients._form', ['client' => new \App\Models\Client()])

            <div class="actions">
                <button class="btn" type="submit">Guardar</button>
                <a class="btn btn-secondary" href="{{ route('clients.index') }}">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
