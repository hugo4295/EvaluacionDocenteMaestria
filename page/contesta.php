<?php

session_start();
if (!isset($_SESSION['matr'])) {
    header("location:../index.php");
}

require_once("clases/autoload.php");
$gruppp = $_SESSION['grup'];
$consulta = new Consultasr();
$Preguntas = $consulta->CargaPreguntas();
$infogrupo = $consulta->Cargargpm($gruppp);

$consulta->cerrar();
$restotalprof = 0;
foreach($infogrupo as $dato){
  $restotalprof++; 
}
//$restotalprof = count($infogrupo);
//echo $restotalprof;
/*foreach($infogrupo as $igpo){
    echo $igpo->nombre.",".$igpo->Materia.",".$igpo->claveProf.",".$igpo->idG."<br>";
}*/
$periodoactual = "2033";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/clasetablas.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
  <title>Tabla con Desplazamiento</title>
</head>
<body>
   <div class="image-section">
    <img src="./../assets/resources/images/edoMex.jpg" alt="edomex" style="width: 120px; height: 85px;">
    <img src="./../assets/resources/images/tecMX.png" alt="TECNOLOGICO" style="width: 160px; height: 85px;">
    <img src="./../assets/resources/images/logoTeso.png" alt="tesoem" style="width: 180px; height: 85px;">
  </div>

  <div class="text-section">
    <div class="contenedor-titulo">
        <label>Matricula: </label><span><?= $_SESSION['matr']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Grupo: </label><span><?= $_SESSION["grup"]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Estatus: </label><span><?= $_SESSION["sta"]; ?></span>
    </div>
    <div style="text-align: center;">
            <h1>INSTRUMENTO DE EVALUACIÓN AL DESEMPEÑO DOCENTE</h1>
            <h3>SEMESTRE 2025-1</h3>
            </div>
 
    <p style="text-size: 25px;">
                El presente instrumento tiene como objetivo conocer tu apreciación acerca del desempeño de tus profesores(as), lo que les permitirá apreciar sus fortalezas y atender sus áreas de oportunidad. Las respuestas son anónimas y los resultados se comunican a los profesores(as) después de que han entregado las calificaciones a la Coordinación. <br><br>
                La información que nos brindes, será de gran utilidad para que los profesores(as) contribuyan a elevar la calidad educativa que la escuela te ofrece. Para ello, es necesario que contestes reflexivamente con sinceridad, responsabilidad y precisión a las cuestiones que se presentan. <br><br>
                La escala de calificación está en el rango de "1" a "5", anota el número que mejor represente tu punto de vista de cada docente, conforme a la siguiente escala:<br><br>
                1= Malo, Nunca, NO<br>
                2= Regular, Pocas veces<br>
                3= Bien, Algunas veces<br>
                4= Muy Bien, Generalmente<br>
                5= Excelente, Siempre, SI
    </p>
  </div>
  <div class="table-container">
    <form method="post" action="registra.php">    
        <table>
          <thead>
            <tr>
              <?php

                $listaclaveprof;
                $arregloprof=1;
                echo "<th>Profesores(as) </th>";
                foreach($infogrupo as $igpo){
                    echo'<th>'.mb_convert_encoding($igpo["nombre"],"UTF-8", "ISO-8859-1").'<br>'.mb_convert_encoding($igpo["Materia"],"UTF-8", "ISO-8859-1").'</th>';
                    $listaclaveprof[$arregloprof]=$igpo["claveProf"];
                    $arregloprof++;
                }
                ?>
            </tr>
            <tr>
                <th colspan="<?php echo $restotalprof+1 ?>" style="text-align: center;">PREGUNTAS</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $fila=1;
                foreach($Preguntas as $pregunta){
                    echo'<tr>
                          <td>'.$pregunta["numP"].' ¿'.mb_convert_encoding($pregunta["preg"],"UTF-8", "ISO-8859-1").'?</td>';
                          for ($i=1;$i<=$restotalprof;$i++){
                            if ($pregunta["numP"]==26){
                            echo '<td><input type="text" name="p'.$fila.''.$i.'" placeholder="Escriba un comentario" required="required"> </td>';
                            }else{
                            echo '<td><input type="numeric" name="p'.$fila.''.$i.'" pattern="[1-5]" placeholder= "1-5" required="required"> </td>';
                            }
                        }
                echo '</tr>';
                          $fila++;
                }             
                ?>
          </tbody>
        </table>
                <input type="hidden" name="periodo" value="<?php echo $periodoactual ?>">
                <input type="hidden" name="totalprofes" value="<?php echo $restotalprof ?>">
                <?php
                    for ($i=1;$i<=$restotalprof;$i++){
                        echo '<input type="hidden" name="claveprofesor'.$i.'" value="'.$listaclaveprof[$i].'">';
                            }
                ?>
                <br>
                <input type="submit" class="btn btn-lg btn-primary btn-block" style="background-color: #9f2c41;" value="ENVIAR">
                
      </form>
  </div>

</body>
</html>
