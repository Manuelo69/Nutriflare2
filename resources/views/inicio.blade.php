<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    @vite('resources/css/app.css')
</head>

<body class=" flex bg-cover font-custom justify-center items-center"
    style="background-image: url({{ asset('assets/imagenes/inicio.jpg') }})">
    <div class="absolute top-1/2 right-56 transform -translate-y-1/2">
        <div class="flex flex-col items-center content-center justify-center">
            <div class="flex">
                <img src="{{ asset('assets/imagenes/logoNutriflare.png') }}" alt="NutriflareLogo" class="h-80">
            </div>
            <div class="flex flex-col my-4 items-center">
                <p class="font-bold text-4xl text-white my-2 text-shadow">Bienvenido a Nutriflare</p>
                <p class="text-2xl font-bold text-white my-1 text-shadow">Rutinas de entrenamiento</p>
                <p class="text-2xl font-bold text-white my-1 text-shadow">Seguimiento del progreso</p>
                <p class="text-2xl font-bold text-white my-1 text-shadow">Y mucho más...</p>
            </div>
            <div class="flex flex-row mt-4">
                <a href="{{ route('login') }}" class="boton-inicio focus:outline-none focus:shadow-outline">Iniciar
                    sesión</a>
                <a href="{{ route('register') }}"
                    class="boton-inicio focus:outline-none focus:shadow-outline">Registrarse</a>
            </div>
        </div>
    </div>
</body>



</html>
