<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Demande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('demande.submit') }}" method="POST">
        @csrf
    <div class="mb-3">
        <label for="typeProbleme" class="form-label">Type de problème:</label>
        <input type="text" class="form-control @error('typeProbleme') is-invalid @enderror" id="typeProbleme" name="typeProbleme" value="{{ old('typeProbleme') }}">
        @error('typeProbleme') <p class="error">{{ $message }}</p> 
        <div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <br>
    <div class="mb-3"> <label for="description" class="form-label">Description:</label>
        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
        @error('description') <p class="error">{{ $message }}</p> 
         <div class="invalid-feedback">{{ $message }}</div>@enderror

        <br>
    <div class="mb-3"><label for="statut" class="form-label">Statut:</label>
        <select id="statut" name="statut" class="form-select @error('statut') is-invalid @enderror">
            <option value="non affecté">Non Affecté</option>
            <option value="affecté en cours">Affecté en Cours</option>
            <option value="affecté en attente">Affecté en Attente</option>
            <option value="traité">Traité</option>
            <option value="clôturé">Clôturé</option>
        </select>
        @error('statut') <p class="error">{{ $message }}</p> 
        <div class="invalid-feedback">{{ $message }}</div>@enderror</div>
        

        <br>

        <button type="submit" class="btn btn-primary w-100">Soumettre</button>
    </form>

</body>
</html>
