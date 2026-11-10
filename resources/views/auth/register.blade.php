@extends('layout.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h3 class="text-center mb-4">Inscription</h3>
        <form method="POST" action="{{ route('register.post') }}">
    @csrf
    <div class="mb-3">
        <label for="uti_nom">Nom</label>
        <input type="text" name="uti_nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="uti_prenom">Prénom</label>
        <input type="text" name="uti_prenom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="uti_email">Email</label>
        <input type="email" name="uti_email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="uti_password">Mot de passe</label>
        <input type="password" name="uti_password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="uti_password_confirmation">Confirmer le mot de passe</label>
        <input type="password" name="uti_password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success w-100">S'inscrire</button>
</form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}">Déjà inscrit ? Se connecter</a>
        </div>
    </div>
</div>
@endsection
