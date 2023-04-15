<?php
    /* Conexion a la BBDD */
    $servername = "localhost";
    $dbname = "";
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

/************* CREAR LA BASE DE DATOS euromillones ***********/
try{
    $mensaje="DROP DATABASE IF EXISTS euromillones;";
    $mensaje.="CREATE DATABASE euromillones;";
    $mensaje.="USE euromillones;";
    
    /* Creacion tabla 'euromillones' */
    $mensaje.="DROP TABLE IF EXISTS `sorteos`;";
    $mensaje.="CREATE TABLE `sorteos` (";
    $mensaje.="  `codigo` int(6) unsigned NOT NULL AUTO_INCREMENT,";
    $mensaje.=" `fecha` char(12)  NOT NULL,";
    $mensaje.=" `num1` int(2) DEFAULT NULL,";
    $mensaje.=" `num2` int(2) DEFAULT NULL,";
    $mensaje.=" `num3` int(2) DEFAULT NULL,";
    $mensaje.=" `num4` int(2) DEFAULT NULL,";
    $mensaje.=" `num5` int(2) DEFAULT NULL,";
    $mensaje.=" `num6` int(2)  DEFAULT NULL,";
    $mensaje.=" `num7` int(2)  DEFAULT NULL,";
    $mensaje.=" PRIMARY KEY (`codigo`)";
    $mensaje.=") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    
    /* Creacion tabla 'usuarios' */
    $mensaje.="DROP TABLE IF EXISTS `usuarios`;";
    $mensaje.="CREATE TABLE `usuarios` (";
    $mensaje.="  `usuario` varchar(30) NOT NULL,";
    $mensaje.="  `password` varchar(100) NOT NULL,";
    $mensaje.="  PRIMARY KEY (`usuario`)";
    $mensaje.=") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    
    $consulta = "$mensaje";
    $datos = $conexion->prepare($consulta);
    $datos->execute();
    $registro = $datos->fetchAll(PDO:: FETCH_ASSOC);
    if(!$registro==0){
        $mensaje =  "Error al crear la Base de datos";
    }
    else{
        echo "<br>Base de datos $dbname creada CORRECTO";
    }
}catch(PDOException $e){
    echo "<br>Error: ".$e->getMessage();
}
    
// Insertar datos en la tabla usuarios
$consulta= 'INSERT INTO `usuarios`(`usuario`, `password`) VALUES ("usuario", "'.password_hash("1234", PASSWORD_DEFAULT).'");';

$datos=$conexion->prepare($consulta); 

if($datos->execute()){
    echo "<br>Datos introducidos en la tabla usuarios CORRECTO";
}
$registro = $datos->fetch(PDO:: FETCH_ASSOC);

?>
