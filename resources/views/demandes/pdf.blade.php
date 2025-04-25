<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande #{{ $demande->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; color: #374151; }
        .value { margin-top: 5px; }
        .status { 
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
            background-color: #FEF3C7;
            color: #92400E;
        }
        .status.completed { 
            background-color: #D1FAE5;
            color: #065F46;
        }
        .footer { 
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #6B7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Détails de la Demande #{{ $demande->id }}</h1>
    </div>

    <div class="section">
        <div class="label">Type de Problème</div>
        <div class="value">{{ $demande->typeProbleme }}</div>
    </div>

    <div class="section">
        <div class="label">Description</div>
        <div class="value">{{ $demande->description }}</div>
    </div>

    <div class="section">
        <div class="label">Bureau de Poste</div>
        <div class="value">{{ $demande->bureauDePoste->intitule_fr }}</div>
    </div>

    <div class="section">
        <div class="label">Statut</div>
        <div class="value">
            <span class="status {{ $demande->statut === 'traité' ? 'completed' : '' }}">
                {{ $demande->statut }}
            </span>
        </div>
    </div>

    <div class="section">
        <div class="label">Date de Création</div>
        <div class="value">{{ $demande->created_at->format('d/m/Y H:i') }}</div>
    </div>

    <div class="section">
        <div class="label">Dernière Mise à Jour</div>
        <div class="value">{{ $demande->updated_at->format('d/m/Y H:i') }}</div>
    </div>

    <div class="footer">
        Document généré le {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>