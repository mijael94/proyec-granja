<?php //Ejemplo curso PHP aprenderaprogramar.com

$time = time();



$menu="
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
    <link rel='stylesheet' type='text/css' href='css/estilos.css'>
    <script type='text/javascript' src='js/funcion.js'>
    </script>
</head>
<body>
<center>
REGISTRO GALPON N°1
</center>
<br>
<br>
<div class='principal'>


<div class='inicio'>
   

    <label for='FECHA INICIO'>
    FECHA INICIO:</label>
    <br>
    <br>
    <input type='date' id='FECHA' name='trip-start'
        value='2018-07-22'
        min='2018-01-01' max='2018-12-31'>

    <br>
    <br>
        
</div>




<div class='observacion'>
OBSERVACION:
<br>
<br>
<input type='text' name='' onkeypress='solotexto()'>
<br>
<br>

</div>

</div>
<center>
<a class='btn' href='work.html'><button  >Continuar</button></a>
</center>
<br>
<br>
FECHA DE INICIO: ".date('d-m-Y', $time)." 
</body>
</html>



";
echo $menu;

?>