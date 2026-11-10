<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAROUELI - TECH</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #0b2b3a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logo-container {
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        .logo-container img {
            width: 600px;
            animation: zoom 5s ease-in-out infinite alternate;
        }

        .logo-text {
            color: white;
            font-size: 1.6rem;
            margin-top: 15px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes zoom {
            from { transform: scale(1); }
            to { transform: scale(1.08); }
        }
    </style>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('accueil') }}";
        }, 2500);
    </script>
</head>

<body>
    <div class="logo-container">
        <img src="{{ asset('Images/logo-baroueli-tech.png') }}" alt="Logo BAROUELI-TECH">
        <div class="logo-text">BAROUELI - TECH</div>
    </div>
</body>
</html>
