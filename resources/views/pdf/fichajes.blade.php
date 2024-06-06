<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Fichajes</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <h2>Reporte de Fichajes</h2>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Fichaje</th>
                <th>Tipo</th>
                <th>Tipo Parada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fichajes as $fichaje)
            <tr>
                <td>{{ $fichaje['Usuario'] }}</td>
                <td>{{ $fichaje['Fichaje'] }}</td>
                <td>{{ $fichaje['Tipo'] }}</td>
                <td>{{ $fichaje['TipoParada'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>