@extends('layouts.app')

@section('title', $client->name)

@section('content')
    <div class="card">
        <h1>{{ $client->name }}</h1>

        <dl>
            <dt>Email</dt>
            <dd>{{ $client->email }}</dd>

            <dt>Teléfono</dt>
            <dd>{{ $client->phone ?? '—' }}</dd>

            <dt>Dirección</dt>
            <dd>{{ $client->address ?? '—' }}</dd>

            <dt>Creado</dt>
            <dd>{{ $client->created_at->format('d/m/Y H:i') }}</dd>
        </dl>

        <div class="actions" style="margin-top: 1.5rem;">
            <a class="btn" href="{{ route('clients.edit', $client) }}">Editar</a>
            <a class="btn btn-secondary" href="{{ route('clients.index') }}">Volver</a>

            <form method="POST" action="{{ route('clients.destroy', $client) }}"
                  onsubmit="return confirm('¿Eliminar este cliente?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Eliminar</button>
            </form>
        </div>
    </div>
@endsection
