@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="p-4 shadow-lg card">
        <h2 class="mb-4 text-center">Liste des Demandes</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($demandes->isEmpty())
            <p class="text-center">Aucune demande enregistrée.</p>
        @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Type de problème</th>
                        <th>Description</th>
                        
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($demandes as $demande)
                        <tr>
                            <td>{{ $demande->typeProbleme }}</td>
                            <td>{{ $demande->description }}</td>
                            <td>{{ $demande->date_de_demande }}</td>
                            <td>
                                @php
                                    $statusColors = [
                                        'non affecté' => 'bg-secondary',
                                        'affecté en cours' => 'bg-warning',
                                        'affecté en attente' => 'bg-info',
                                        'traité' => 'bg-success',
                                        'clôturé' => 'bg-danger'
                                    ];
                                @endphp
                                <span class="badge {{ $statusColors[$demande->statut] ?? 'bg-primary' }}">
                                   {{ $demande->statut ?? 'Inconnu' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
