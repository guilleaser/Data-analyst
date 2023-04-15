<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../style/home.css">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <!-- Navegador -->
    <nav id="nav">
        <ul id="nav_list">
            <li><a href="">Home</a></li>
            <li><a href="">Equipos</a></li>
            <li><a href="">Jugadores</a></li>
            <li><a href="">Partidos</a></li>
            <li><a href="">Estadísticas</a></li>
        </ul>
    </nav>
    <!-- Buscador -->
    <form action="files/php/home.php">
        <label for="buscar">Buscador</label>
        <input type="text" name="buscador" id="buscador" placeholder="Inserta lo que quieras buscar">
        <input type="submit" value="Log in">
    </form>
    <!-- Equipos -->
    <h3>Equipos</h3>
    <ul>
        <li>Alevin</li>
        <li>"equipos"</li>
    </ul>
    <!-- Resumen de estadisticas -->
    <h3>Resumen de estadisticas</h3>
    <h2>Estadisticas de jugadores destacados</h2>
    <table>
        <tr>
            <th>Jugador</th>
            <th>Partidos</th>
            <th>% min jugados</th>
            <th>Goles</th>
            <th>% goles partido</th>
            <th>5 goles del equipo</th>
            <th>Asistencias</th>
            <th>% asistencias por partido</th>
            <th>% asistencias del equipo</th>
            <th>% asistencia entrenamientos</th>
            <th>Dias lesionado</th>
            <th>Hombre del partido</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <h4>Estadisticas del equipo</h4>
    <table>
        <tr>
            <th>Partidos</th>
            <th>Ganados</th>
            <th>Empatados</th>
            <th>Perdidos</th>
            <th>Goles a favor</th>
            <th>Min goles a favor</th>
            <th>Goles en contra</th>
            <th>Min goles en contra</th>
            <th>Goles por fallos graves</th>
            <th>Min Goles por fallos graves</th>
            <th>% Goles por fallos graves</th>
            <th>% goles corta distancia</th>
            <th>% goles media distancia</th>
            <th>% asistencia entrenamientos</th>
            <th>Dias lesionado</th>
            <th>Hombre del partido</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

</body>

</html>