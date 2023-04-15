<?php
// Conexion a la bd
require "bd_conexion.php";
require "formulario.php";
echo "<a href='bd.php'>Cargar BD</a>";
$contador = 0;
if(isset($_POST['enviar'])){
    // Extraccion de los datos del fichero CSV
  $filename=$_FILES["file"]["name"];
  $info = new SplFileInfo($filename);
  $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

   if($extension == 'csv')
   {
	$filename = $_FILES['file']['tmp_name'];
	$handle = fopen($filename, "r");
	while( ($data = fgetcsv($handle, 1000, ";") ) !== FALSE )
	{
        $contador++;
        // Corregimos las fechas que vienen con menos digitos
        if (strlen($data[0])<32)
        $data[0] = "0".$data[0];
    
        $fecha = substr($data[0], 0 , strpos($data[0], ','));
        $n1 = substr($data[0], 11 , 2);
        $n2 = substr($data[0], 14 , 2);
        $n3 = substr($data[0], 17 , 2);
        $n4 = substr($data[0], 20 , 2);
        $n5 = substr($data[0], 23 , 2);
        $e1 = substr($data[0], 27 , 2);
        $e2 = substr($data[0], 30 , 2);

        // Insertar los datos en la BD euromillones
        $consulta= "INSERT INTO sorteos (fecha, num1, num2, num3, num4,num5, num6, num7) VALUES (
            '$fecha', '$n1', '$n2', '$n3', '$n4', '$n5', '$e1', '$e2')";
        $datos=$conexion->prepare($consulta); 
        if($datos->execute()){
        }else{
            echo "Error linea: $contador";
        }
        $registro = $datos->fetch(PDO:: FETCH_ASSOC);
    }
      fclose($handle);
   }
   echo "<br>Se han introducido $contador lineas.";
}
// Vaciar la tabla sorteos
if (isset($_POST['vaciar'])){
    $consulta= 'TRUNCATE sorteos;';

    $datos=$conexion->prepare($consulta); 

    if($datos->execute()){
        echo "<br>Datos eliminados correctamente";
    }
    $registro = $datos->fetch(PDO:: FETCH_ASSOC);
}

    /******************* PREDICCIONES ***************/
    $numero1 =[];
    $numero2 =[];
    $numero3 =[];
    $numero4 =[];
    $numero5 =[];
    $numero6 =[];
    $numero7 =[];
    $numero  =[];
    $estrella  =[];
    $dif1 = [];
    $dif2 = [];
    $dif3 = [];
    $dif4 = [];
    $dif6 = [];

if (isset($_POST['calculos'])){
    // Numeros mas repetidos en cada columna
    $n = 0;
    for ($i=0;$i<=6; $i++){
        $n++;
        $consulta = "select num$n, count(num$n) as 'total'
                        from sorteos
                        group by num$n
                        order by count(num$n) desc
                        limit 8;";
        $datos = $conexion->prepare($consulta);
        $datos->execute();
        while ($registro = $datos->fetch(PDO:: FETCH_ASSOC)){
            $calculo = "num$n";
            // Meter datos en el array
            if($n == 1)array_push($numero1, $registro[$calculo]);
            if($n == 2)array_push($numero2, $registro[$calculo]);
            if($n == 3)array_push($numero3, $registro[$calculo]);
            if($n == 4)array_push($numero4, $registro[$calculo]);
            if($n == 5)array_push($numero5, $registro[$calculo]);
            if($n == 6)array_push($numero6, $registro[$calculo]);
            if($n == 7)array_push($numero7, $registro[$calculo]);
        }
        echo "<table>";
    }

        // Total numeros
        $n = 0;
        for ($i=0;$i<=6; $i++){
            $n++;
        
            $consulta = "select distinct num$n, count(num$n)
                        FROM sorteos 
                        group by num$n
                        order by count(num$n) DESC
                        limit 12;";
            $datos = $conexion->prepare($consulta);
            $datos->execute();
            while ($registro = $datos->fetch(PDO:: FETCH_ASSOC)){
                $calculo = "num$n";
                if ($n<=5) array_push($numero, $registro[$calculo]);
                if ($n>5) array_push($estrella, $registro[$calculo]);
            }
        }

    // diferencia media entre numeros posiciones
    $n = 0;
    for ($i=0;$i<=5; $i++){
        $n++;
        if($n==5) continue;
        
        $consulta = "select num$n, AVG((num".($n+1).")-num$n) as media
                        from sorteos 
                        order by media DESC
                        limit 6;";
        $datos = $conexion->prepare($consulta);
        $datos->execute();
        while ($registro = $datos->fetch(PDO:: FETCH_ASSOC)){
            if ($registro['media']<0) continue;
            // Meter datos en el array
            $calculo = "num$n";
            array_push($dif1, $registro['media']);

            if($n == 1)array_push($dif1, $registro['media']);
            if($n == 2)array_push($dif2, $registro['media']);
            if($n == 3)array_push($dif3, $registro['media']);
            if($n == 4)array_push($dif4, $registro['media']);
            if($n == 6)array_push($dif6, $registro['media']);

        }
    }




    /****** Variacion media entre posiciones ******/
    function calcularMedia($array){
        foreach ($array as $c => $v){
            $resultado = round($v + rand(-1,1));
        }
        return $resultado;
    }
    /* Diferencias medias entre posiciones */
    $dif1 = calcularMedia($dif1);
    $dif2 = calcularMedia($dif2);
    $dif3 = calcularMedia($dif3);
    $dif4 = calcularMedia($dif4);
    $dif6 = calcularMedia($dif6);

    /* Combinacion mas basica */
    for ($i=0;$i<2;$i++){
        echo "<br>Combinacion con numeros frecuentes por posicion: ";
        echo $numero1[array_rand($numero1)].", ".$numero2[array_rand($numero2)].", ".$numero3[array_rand($numero3)].", ".
        $numero4[array_rand($numero4)].", ".$numero5[array_rand($numero5)].". E: ".
        $numero6[array_rand($numero6)].", ".$numero7[array_rand($numero7)].".";
    }

    /* Combinacion respecto a las diferencias medias */
    echo "<br>";
    for ($i=0;$i<2;$i++){
        $n1 = $numero1[array_rand($numero1)];
        $n2 = ($n1+($dif1 + rand(-1,1)));
        $n3 = ($n2+($dif2 + rand(-1,1)));
        $n4 = ($n3+($dif3 + rand(-1,1)));
        $n5 = ($n4+($dif4 + rand(-1,1)));
        $e1 = $numero6[array_rand($numero6)];
        $e2 = $numero7[array_rand($numero7)];
        echo "<br>Combiancion dependiendo las diferencias medias: $n1, $n2, $n3, $n4, $n5. E: $e1, ".($e1+($dif6 + rand(-1,1)));
    }

    /* Combinacion respecto numeros mas frecuentes por posicion y diferencias medias */
    echo "<br>";


    $combinacion = [];
    while (count($combinacion)<7){
        $n1 = $numero1[array_rand($numero1)];
        $n2 = $numero2[array_rand($numero2)];
        $n3 = $numero3[array_rand($numero3)];
        $n4 = $numero4[array_rand($numero4)];
        $n5 = $numero5[array_rand($numero5)];
        $e1 = $numero6[array_rand($numero6)];
        $e2 = $numero7[array_rand($numero7)];

        if (in_array(($n1 + $dif1), $numero2)){
            $combinacion [0] = $n1;
            $n2 = ($n1 + $dif1);
            $combinacion [1] = $n2;
        }
        if (in_array(($n2 + $dif2), $numero3)){
            $n3 = ($n2 + $dif2);
            $combinacion [2] = $n3;
        }
        if (in_array(($n3 + $dif3), $numero4)){
            $n4 = ($n3 + $dif3);
            $combinacion [3] = $n4;
        }
        if (in_array(($n4 + $dif4), $numero5)){
            $n5 = ($n4 + $dif4);
            $combinacion [4] = $n5;
        }
        if (in_array(($e1 + $dif6), $numero7)){
            $combinacion [5] = $e1;
            $e2 = ($e1 + $dif6);
            $combinacion [7] = $e2;
        }
    }
    $salida = "<br>Combinacion num frecuentes + diferencia de posiciones: ";
    $cont = 0;
    foreach ($combinacion as $c => $v){
        $cont++;
        if ($cont == 1 || $cont == 6) $salida.= "$v";
        if ($cont == 2 || $cont == 3 || $cont == 4 || $cont == 5 || $cont == 7) $salida.= ", $v";
        if ($cont == 5) $salida.= ". E: ";
    }
    echo $salida;
  
}

?>

