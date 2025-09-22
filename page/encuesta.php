<?php

session_start();
if (!isset($_SESSION['matr'])) {
    header("location:../index.php");
}

require_once("clases/autoload.php");
$gruppp = $_SESSION['grup'];
$consulta = new Consultas();
$Preguntas = json_decode($consulta->CargaPreguntas());
$infogrupo = json_decode($consulta->Cargargpm($gruppp));

$consulta->cerrar();
$restotalprof = count($infogrupo);
//echo $restotalprof;
/*foreach($infogrupo as $igpo){
    echo $igpo->nombre.",".$igpo->Materia.",".$igpo->claveProf.",".$igpo->idG."<br>";
}*/
$periodoactual = "2025-1";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosbase.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Evaluacion Docente</title>

</head>

<body>
    <header>
        <div class="image-container">
            <img src="./../assets/resources/images/edoMex.jpg" alt="edomex" class="navbar-image">
            <img src="./../assets/resources/images/tecMX.png" alt="TECNOLOGICO" class="navbar-image">
            <img src="./../assets/resources/images/logoTeso.png" alt="tesoem" class="navbar-image">
        </div>
    </header>
    <div class="contenedor-titulo">
        <label>Matricula: </label><span><?= $_SESSION['matr']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Grupo: </label><span><?= $_SESSION["grup"]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>Estatus: </label><span><?= $_SESSION["sta"]; ?></span>
    </div>
    <div class="contenedor">
        <div align="center">
            <h2>INSTRUMENTO DE EVALUACIÓN AL DESEMPEÑO DOCENTE</h2>
            <h3>SEMESTRE 2025-1</h3>
            <p align="justify" style="padding:25px">
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
    </div>
    <div class="contenedor-form">
    <form method="post" action="registra.php" style="margin-left: 1em;">
            <table class="table" style="background-color:#b9fb81;"  border="3"  cellpadding="1" cellspacing="1">
                <tr>
                <?php
            
            $listaclaveprof;
            $arregloprof=1;
            echo "<th>Profesores(as) </th>";
            foreach($infogrupo as $igpo){
                echo'<th>'.$igpo->nombre.'<br>'.$igpo->Materia.'</th>';
                $listaclaveprof[$arregloprof]=$igpo->claveProf;
                $arregloprof++;
             }             
            ?>
                </tr>
                <tr>
                <th colspan="<?php echo $restotalprof ?>" style="text-align: center;">PREGUNTAS</th>
            </tr>
            <?php
             $fila=1;
             foreach($Preguntas as $pregunta){
                echo'<tr>
                      <td>'.$pregunta->numP.' ¿'.$pregunta->preg.'?</td>';
                      for ($i=1;$i<=$restotalprof;$i++){
                        echo '<td><input type="numeric" name="p'.$fila.''.$i.'" pattern="[1-5]" placeholder= "1-5" required="required"> </td>';  
                    }
             echo '</tr>';
                      $fila++;
             }             
             ?>
            </table>
            <?php
            echo '<input type="hidden" name="periodo" value="'.$periodoactual.'">';
            echo '<input type="hidden" name="totalprofes" value="'.$restotalprof.'">';
                 for ($i=1;$i<=$restotalprof;$i++){
                    echo '<input type="hidden" name="claveprofesor'.$i.'" value="'.$listaclaveprof[$i].'">';
                        }
            ?>
            <br>
            <div class="contenedor" style="text-align: center;">
                <button class="btn btn-lg btn-primary btn-block" type="submit">ENVIAR</button>
            </div>
            <br>
            
    </form>
    </div>
</body>
</html>