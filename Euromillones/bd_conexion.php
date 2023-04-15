<?php
/* Conexion a la BBDD */
    $servername = "localhost";
    $dbname = "euromillones";
    $username = "root";
    $password = "";

    try {
        $conexion = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p id='loginConexion'>Login correcto $dbname</p>";
    }
    catch(PDOException $e){
        echo "<h1>Conexion a la BBDD <b> $dbname >/b> fallida</h1>".$e->getMessage();
    }
    ?>