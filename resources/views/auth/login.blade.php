@extends('layout.app')

@section('content')
<div class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50" style="z-index:1050;">
    <div class="card shadow-lg p-4" style="width: 400px; z-index:1060;">
        <h3 class="text-center mb-4">Connexion</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de Passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('register') }}">Créer un compte</a>
        </div>
    </div>
</div>
@endsection
