@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
    <div class="card">
        <div class="actions" style="justify-content: space-between; margin-bottom: 1rem;">
            <h1 style="margin: 0;">Clientes</h1>
            <a class="btn" href="{{ route('clients.create') }}">Nuevo cliente</a>
        </div>

        @if ($clients->isEmpty())
            <p class="muted">Todavía no hay clientes registrados.</p>
        @else
            <table>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone ?? '—' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-secondary" href="{{ route('clients.show', $client) }}">Ver</a>
                                <a class="btn" href="{{ route('clients.edit', $client) }}">Editar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination">{{ $clients->links() }}</div>
        @endif
    </div>
@endsection
