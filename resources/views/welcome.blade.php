<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Volvagia') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;400&family=Russo+One&display=swap"
        rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div id="main">
        <div class="container">
            <div class="row justify-content-center vh-100 align-items-center">
                <div class="col-11 col-md-4 p-4 text-center border rounded bg-dark shadow" style="--bs-bg-opacity:.5">
                    <h1 class="logo text-white">Volvagia</h1>
                    <h2 class="text-warning">Bienvenido..</h2>
                    <br>
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-outlined">Ingresar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
