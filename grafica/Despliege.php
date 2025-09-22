<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de docentes</title>
    <!--Load the AJAX API-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="./js/jquery-3.7.1.min.js"></script>

</head>
<body>
    <form action="creapdf.php" method="POST" target="_blank">
        <input type="hidden" name="textimg" id="textimg">
        <input type="hidden" name="clavprof" id="clavprof">
        <label for="claveprof">Seleccione profesor</label>
        <select name="claveprof" id="claveprof" class="mb-3">
            <option value="0">Seleccione un profesor</option>
<?php
require_once("clases/autoload.php");
$consulta = new Consultas();
$datos = $consulta->Profesores();
foreach($datos as $dato){
    echo "<option value='".$dato["claveProf"]."'>".mb_convert_encoding($dato["mprofesor"],"UTF-8", "ISO-8859-1")."</option>\n";
}
$consulta->cerrar();
?>
</select>
<input class="btn btn-outline-success" type="submit" value="Graficar">
</form>
<div id="infodocente"></div>
<div id="tablamat"></div>
<div id="aspeva"></div>

<div class="container" id="grafico" style="width: 100%;height: 100%;"></div>
<div class="container" style="text-align: center; font-size: 15pt;">
    Rangos de evaluación:<br>
    Menor a 2.49 Insatisfactorio | 2.5 a 3.49 Bien | 3.5 a 4.49 Muy Bien | 4.5 a 5.0 Excelente
</div>
<script>
    //seccion de variables globales 
    var jsarrecal = [];
    var jscalcolores = [];
    var matriculaenvio=0;
        $(document).ready(function() {
            // Cuando se selecciona una opción del dropdown
            $('#claveprof').change(function() {
                const selectedValue = $(this).val();

                if (selectedValue) {
                    const currentUrl = window.location.origin + window.location.pathname;
                    const newUrl = currentUrl + '?cveprof=' + selectedValue;

                    // Redirige a la URL con el nuevo parámetro
                    window.location.href = newUrl;
                }
            });

            // Al cargar la página, verifica si existe el parámetro "selected" en la URL
            const urlParams = new URLSearchParams(window.location.search);
            const selectedParam = urlParams.get('cveprof');
            

            // Si existe el parámetro, selecciona el valor correspondiente en el dropdown
            if (selectedParam) {
                matriculaenvio= selectedParam;
                //$('#claveprof').val(selectedParam);
                
                // codigo para generar la grafica
                <?php
                 if (!isset($_GET["cveprof"])){
                    $claveprof = 272;
                    }else{
                        $claveprof = $_GET["cveprof"];
                    }
                $datos=[];
                $totalxmat=[];
                $totalDAGR=[];
                $datosFinales=[];              
                $consulta = new Consultas();
                $datos =  $consulta->DatosDocente($claveprof);
                $datos1 =  $consulta->DatosDocente($claveprof);
                 foreach($datos1 as $dato){
                    $totalalm=$consulta->DatosAlumnototalGrupo($dato["idG"]);
                    $totalxmat[] = $totalalm[0]["total"];
                    $totalDR=$consulta->DatosAlumnototalGrupoRealizado($dato["idG"]);
                    $totalDAGR[] = $totalDR[0]["total"];
                    
                    $datosFinales[] = [
                        "claveMat" => $dato["claveMat"],
                        "mmateria" => mb_convert_encoding($dato["mmateria"],"UTF-8", "ISO-8859-1"),
                        "mprofesor" => mb_convert_encoding($dato["mprofesor"],"UTF-8", "ISO-8859-1"),
                        "idG" => $dato["idG"]
                    ];
                 }

                 //obtenemos los promedios para listarlso junto con su descripcion
                 $prom=0;
                 $texto="";
                 $arrecal=[];
                 $evafinal=0;
                 $letra="";
                 $aeva=[]; //aspectos a evaluar letrero
                 $caltexto=[];
                 $calcolores=[]; //colores de las calificaciones
                 $promedios = $consulta->seccionpromedio($claveprof);
                 foreach($promedios as $promedio){
                    if ($promedio["seccion"] == 1){
                        $texto='A) Dominio de la asignatura';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['A']=$prom;
                        $evafinal+=$prom;
                        $letra="A";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 2){
                        $texto='B) Planificación de curso';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['B']=$prom;
                        $evafinal+=$prom;
                        $letra="B";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 3){
                        $texto='C) Ambientes de aprendizaje';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['C']=$prom;
                        $evafinal+=$prom;
                        $letra="C";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 4){
                        $texto='D) Estategias, métodos y técnicas';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['D']=$prom;
                        $evafinal+=$prom;
                        $letra="D";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 5){
                        $texto='E) Motivación';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['E']=$prom;
                        $evafinal+=$prom;
                        $letra="E";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 6){
                        $texto='F) Evaluación';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['F']=$prom;
                        $evafinal+=$prom;
                        $letra="F";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 7){
                        $texto='G) Comunicación';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['G']=$prom;
                        $evafinal+=$prom;
                        $letra="G";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 8){
                        $texto='H) Gestión de curso';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['H']=$prom;
                        $evafinal+=$prom;
                        $letra="H";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 9){
                        $texto='I) Tecnologías de la información y comunicación';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['I']=$prom;
                        $evafinal+=$prom;
                        $letra="I";
                        $aeva[$letra]=$texto;
                    }
                    elseif ($promedio["seccion"] == 10){
                        $texto='J) Satisfacción general';
                        $prom=number_format($promedio["promedio"],2,'.','');
                        $arrecal['J']=$prom;
                        $evafinal+=$prom;
                        $evafinal/=10;
                        $evafinal=number_format($evafinal,2,'.','');
                        $letra="J";
                        $aeva[$letra]=$texto;
                    }

                    if ($prom<=2.49){
                        $caltexto[$letra]='Insatisfactorio';
                        $calcolores[$letra]="red";
                    }elseif ($prom>=2.5 && $prom<=3.49){
                        $caltexto[$letra]='Bien';
                        $calcolores[$letra]="yellow";
                    }elseif ($prom>=3.5 && $prom<=4.49){
                        $caltexto[$letra]='Muy Bien';
                        $calcolores[$letra]="orange";
                    }elseif ($prom>=4.5 && $prom<=5){
                        $caltexto[$letra]='Excelente';
                        $calcolores[$letra]="green";
                    }
                
                    if ($evafinal<=2.49){
                        $finaltexto='Insatisfactorio';
                        $colork="red";
                        $letra="K";
                        $texto='k) Promedio General';
                        $arrecal[$letra]=$evafinal;
                        $aeva[$letra]=$texto;
                        $caltexto[$letra]=$finaltexto;
                        $calcolores[$letra]=$colork;
                    }elseif ($evafinal>=2.5 && $evafinal<=3.49){
                        $finaltexto='Bien';
                        $colork="yellow";
                        $letra="K";
                        $texto='k) Promedio General';
                        $arrecal[$letra]=$evafinal;
                        $aeva[$letra]=$texto;
                        $caltexto[$letra]=$finaltexto;
                        $calcolores[$letra]=$colork;
                    }elseif ($evafinal>=3.5 && $evafinal<=4.49){
                        $finaltexto='Muy Bien';
                        $colork="orange";
                        $letra="K";
                        $texto='k) Promedio General';
                        $aeva[$letra]=$texto;
                        $arrecal[$letra]=$evafinal;
                        $caltexto[$letra]=$finaltexto;
                        $calcolores[$letra]=$colork;
                    }elseif ($evafinal>=4.5 && $evafinal<=5){
                        $finaltexto='Excelente';
                        $colork="green";
                        $letra="K";
                        $texto='k) Promedio General';
                        $aeva[$letra]=$texto;
                        $arrecal[$letra]=$evafinal;
                        $caltexto[$letra]=$finaltexto;
                        $calcolores[$letra]=$colork;
                    }
                }
                $consulta->cerrar();
            
                ?>
                var jsDatos = <?php echo json_encode($datosFinales); ?>;
                var jsTotalxmat = <?php echo json_encode($totalxmat); ?>;
                var jsTotalDAGR = <?php echo json_encode($totalDAGR); ?>;  
                var jsPromedios = <?php echo json_encode($promedios); ?>;
                var jsaeva = <?php echo json_encode($aeva); ?>;
                jsarrecal = <?php echo json_encode($arrecal); ?>;
                var jscaltexto = <?php echo json_encode($caltexto); ?>;
                jscalcolores = <?php echo json_encode($calcolores); ?>;
                var indice=0;      
                // Mostrar el array en la consola
                var cadena="Evaluación por Docentes<br>Tipo de Evaluación: Por Alumnos<br>Periodo: 2025-1<br>Evaluación del Docente: "+jsDatos[0].mprofesor;
                var tablagrupos='<p style="text-align: center;">Materias</p>';
                    tablagrupos=tablagrupos+'<div class="container">';
                    tablagrupos=tablagrupos+'<table class="table table-striped">';
                    tablagrupos=tablagrupos+'<tr>';
                    tablagrupos=tablagrupos+'<th>clave</th>';
                    tablagrupos=tablagrupos+'<th>Grupo</th>';
                    tablagrupos=tablagrupos+'<th>Nombre Completo de la Materia</th>';
                    tablagrupos=tablagrupos+'<th>Inscritos</th>';
                    tablagrupos=tablagrupos+'<th>Evaluaron</th>';
                    tablagrupos=tablagrupos+'</tr>';

                for (info of jsDatos){
                    tablagrupos=tablagrupos+'<tr>';
                    tablagrupos=tablagrupos+'<td>'+info.claveMat+'</td>';
                    tablagrupos=tablagrupos+'<td>'+info.idG+'</td>';
                    tablagrupos=tablagrupos+'<td>'+info.mmateria+'</td>';
                    tablagrupos=tablagrupos+'<td style="text-align: center;">'+jsTotalxmat[indice]+'</td>';
                    tablagrupos=tablagrupos+'<td style="text-align: center;">'+jsTotalDAGR[indice]+'</td>';
                    indice++;
                }
                tablagrupos=tablagrupos+'</table>';
                tablagrupos=tablagrupos+'</div>';

                var aspeva='<p style="text-align: center;">Aspectos a Evaluar</p>';
                aspeva=aspeva+'<div class="container">';
                aspeva=aspeva+'<table class="table table-striped">';
                aspeva=aspeva+'<tr>';
                aspeva=aspeva+'<th>Aspectos evaluados</th>';
                aspeva=aspeva+'<th>Puntaje</th>';
                aspeva=aspeva+'<th>Calificación</th>';
                aspeva=aspeva+'</tr>';
                for (let indice="A".charCodeAt(0) ; indice <="K".charCodeAt(0);indice++){
                    let letra=String.fromCharCode(indice);
                    aspeva=aspeva+'<tr>';
                    aspeva=aspeva+'<td>'+jsaeva[letra]+'</td>';
                    aspeva=aspeva+'<td>'+jsarrecal[letra]+'</td>';
                    aspeva=aspeva+'<td style="color:'+jscalcolores[letra]+';">'+jscaltexto[letra]+'</td>';
                    aspeva=aspeva+'</tr>';
                }
                aspeva=aspeva+'</table>';
                aspeva=aspeva+'</div>';
                // se termina el codigo de generacion de grafica
               
                document.getElementById("infodocente").innerHTML=cadena;
                document.getElementById("tablamat").innerHTML=tablagrupos;
                document.getElementById("aspeva").innerHTML=aspeva;
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                        // se termina el codigo de generacion de grafica
            }
        });

        function drawChart() {
        // Create the data table.
        var datosgrafica="['Rubro', 'Calificación', { role: 'style' }],";
        for (let indice="A".charCodeAt(0) ; indice <="K".charCodeAt(0);indice++){
            let letra=String.fromCharCode(indice);
            datosgrafica+="['"+letra+")',"+ jsarrecal[letra]+", "+jscalcolores[letra]+"],";
        }
        var data = new google.visualization.arrayToDataTable([
            ['Rubro', 'Calificación', { role: 'style' }],
            ['A)', <?php echo $arrecal["A"]; ?>, '<?php echo $calcolores["A"]; ?>'],            // RGB value
            ['B)', <?php echo $arrecal["B"]; ?>, '<?php echo $calcolores["B"]; ?>'],            // English color name
            ['C)', <?php echo $arrecal["C"]; ?> , '<?php echo $calcolores["C"]; ?>'],
            ['D)', <?php echo $arrecal["D"]; ?>, '<?php echo $calcolores["D"]; ?>'],
            ['E)', <?php echo $arrecal["E"]; ?>, '<?php echo $calcolores["E"]; ?>'],
            ['F)', <?php echo $arrecal["F"]; ?>, '<?php echo $calcolores["F"]; ?>'],
            ['G)', <?php echo $arrecal["G"]; ?>, '<?php echo $calcolores["G"]; ?>'],
            ['H)', <?php echo $arrecal["H"]; ?>, '<?php echo $calcolores["H"]; ?>'],
            ['I)', <?php echo $arrecal["I"]; ?>, '<?php echo $calcolores["I"]; ?>'],
            ['J)', <?php echo $arrecal["J"]; ?>, '<?php echo $calcolores["J"]; ?>'],
            ['k)', <?php echo $evafinal; ?>, '<?php echo $colork; ?>' ], // CSS-style declaration
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);

        var options = {
            title: "Resultado Gráfico",
            width: 1300,
            height: 800,
            bar: {groupWidth: "70%"},
            legend: { position: "none" },
            vAxis: {minValue: 0, maxValue: 5},
            backgroundColor:'transparent'
        };

        var chart = new google.visualization.ColumnChart(document.getElementById("grafico"));
        chart.draw(view, options);

        var cadena=chart.getImageURI();
        document.getElementById('textimg').value=cadena;
        document.getElementById('clavprof').value=matriculaenvio;
    }
    </script>
</body>
</html>