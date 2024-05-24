<!DOCTYPE html>
<html>

<head>
    <title>Rutina de {{ $user->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .rutina {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .rutina th,
        .rutina td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .rutina th {
            background-color: #f2f2f2;
        }

        .image-container {
            text-align: center;
        }

        .image-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Rutina de {{ $user->name }} - {{ ucfirst($rutina->dia_semana) }}</h2>
        </div>
        <table class="rutina">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Ejercicio</th>
                    <th>Músculo</th>
                    <th>Series</th>
                    <th>Repeticiones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rutina->ejerciciosRutina as $ejercicioRutina)
                    <tr>
                        <td class="image-container">
                            <img src="{{ public_path('assets/imagenes/' . $ejercicioRutina->ejercicio->imagen) }}"
                                alt="{{ $ejercicioRutina->ejercicio->nombre_ejercicio }}">
                        </td>
                        <td>{{ $ejercicioRutina->ejercicio->nombre_ejercicio }}</td>
                        <td>{{ ucfirst($ejercicioRutina->ejercicio->musculo) }}</td>
                        <td>{{ $ejercicioRutina->series }}</td>
                        <td>{{ $ejercicioRutina->repeticiones }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
