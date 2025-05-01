<!DOCTYPE html>
<html>
<head>
    <title>Ticket #{{ $ticket->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Ticket #{{ $ticket->id }}</h1>
    </div>

    <div class="section">
        <h2>Informations de la Demande</h2>
        <p><span class="label">Type de Problème:</span> {{ $demande->typeProbleme }}</p>
        <p><span class="label">Description:</span> {{ $demande->description }}</p>
        <p><span class="label">Bureau de Poste:</span> {{ $demande->bureauDePoste->intitule_fr }}</p>
        <p><span class="label">Date de Création:</span> {{ $demande->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <h2>Informations du Ticket</h2>
        <p><span class="label">Technicien Assigné:</span> {{ $ticket->technicien->name }}</p>
        <p><span class="label">Observation:</span> {{ $ticket->observation }}</p>
        <p><span class="label">Status:</span> {{ $ticket->status }}</p>
        <p><span class="label">Date de Création:</span> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
    </div>

<!-- Add this section where appropriate in your PDF template -->
<div class="mb-4">
    <h3 class="text-lg font-semibold">Description:</h3>
    <p>{{ $ticket->description ?? 'Aucune description disponible' }}</p>
</div>
</body>
</html>