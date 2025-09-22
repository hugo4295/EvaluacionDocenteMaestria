<?php
require('fpdf/fpdf.php');
require_once("clases/autoload.php");

header('Content-Type: text/html; charset=utf-8');
ini_set("default_charset", "UTF-8");
mb_internal_encoding("UTF-8");
iconv_set_encoding("internal_encoding", "UTF-8");
iconv_set_encoding("output_encoding", "UTF-8");


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // // Logo
    // $this->Image('logo.png',10,8,33);
    // // Arial bold 15
    // $this->SetFont('Arial','B',15);
    // // Movernos a la derecha
    // $this->Cell(80);
    // // Título
    // $this->Cell(30,10,'Title',1,0,'C');
    // // Salto de línea
    // $this->Ln(20);
}

// Pie de página
function Footer()
{
    // // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // // Arial italic 8
    $this->SetFont('Arial','I',8);
    // // Número de página
    //$this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
    $this->Cell(0,4,mb_convert_encoding('Rangos de evaluación:',"ISO-8859-1", mb_detect_encoding('Rangos de evaluación:', "UTF-8, ISO-8859-1, ISO-8859-15", true)),0,1,'C');
    $this->Cell(0,4,mb_convert_encoding('Menor a 2.49 Insatisfactorio | 2.5 a 3.49 Bien | 3.5 a 4.49 Muy Bien | 4.5 a 5.0 Excelente',"ISO-8859-1", mb_detect_encoding('Menor a 2.49 Insatisfactorio | 2.5 a 3.49 Bien | 3.5 a 4.49 Muy Bien | 4.5 a 5.0 Excelente', "UTF-8, ISO-8859-1, ISO-8859-15", true)),0,1,'C');
    $this->Cell(0,4,mb_convert_encoding('Página '.$this->PageNo().'/{nb}',"ISO-8859-1", mb_detect_encoding('Página '.$this->PageNo().'/{nb}', "UTF-8, ISO-8859-1, ISO-8859-15", true)),0,1,'R');

}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$periodo='2025-1';
$claveprofesor=$_POST["clavprof"];
$cadenaimg=$_POST["textimg"];
$img64="data://text/plain;base64,".explode(',',$cadenaimg,2)[1];
$arrecal=array();
$evafinal=0;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$pdf->Image('img/sep24.png',10,10,50);
$pdf->Image('img/tecnmlogo.png',70,10,30);
$pdf->Image('img/escudo.png',5,30,200);
$pdf->Cell(0,4,mb_convert_encoding('Secretaria de Educación Superior',"ISO-8859-1","UTF-8"),0,1,'R');
$pdf->Cell(0,4,mb_convert_encoding('Tecnológico Nacional de México (TecNM)',"ISO-8859-1","UTF-8"),0,1,'R');
$pdf->Cell(0,4,mb_convert_encoding('Tecnológico de Estudios Superiores del Oriente del Estado de México',"ISO-8859-1","UTF-8"),0,1,'R');
$pdf->SetFont('courier','B',10);
$pdf->Cell(0,5,"",0,1);
$consulta = new Consultas();
$datos = $consulta->DatosDocente($claveprofesor);

foreach($datos as $dato){
$pdf->Cell(0,4,mb_convert_encoding('Evaluación por Docentes',"ISO-8859-1","UTF-8"),0,1,'C');
$pdf->Cell(0,4,mb_convert_encoding('Tipo de Evaluación: Por Alumnos',"ISO-8859-1","UTF-8"),0,1,'C');
$pdf->Cell(0,4,mb_convert_encoding('Periodo: '.$periodo,"ISO-8859-1","UTF-8"),0,1,'C');
$pdf->Cell(0,4,mb_convert_encoding('Evaluación del Docente: ',"ISO-8859-1","UTF-8").$dato["mprofesor"],0,1,'C');
break;
}
$pdf->SetFont('courier','B',10);
$pdf->Cell(0,2,"",0,1);
$pdf->Cell(1);
$pdf->Cell(190,6,mb_convert_encoding('Materias',"ISO-8859-1","UTF-8"),1,1,'C');
$pdf->Cell(1);
$pdf->Cell(20,6,mb_convert_encoding('clave',"ISO-8859-1","UTF-8"),1,0,'C');
$pdf->Cell(15,6,mb_convert_encoding('Grupo',"ISO-8859-1","UTF-8"),1,0,'C');
$pdf->Cell(109,6,mb_convert_encoding('Nombre Completo de la Materia',"ISO-8859-1","UTF-8"),1,0,'C');
$pdf->Cell(23,6,mb_convert_encoding('Inscritos',"ISO-8859-1","UTF-8"),1,0,'C');
$pdf->Cell(23,6,mb_convert_encoding('Evaluaron',"ISO-8859-1","UTF-8"),1,1,'C');
$pdf->SetFont('courier','',10);
$x=$pdf->GetX();
$y=$pdf->GetY();
foreach($datos as $dato){
    $cvmat=$dato["claveMat"];
    $cvmatdiv=explode("_",$cvmat);
    if (count($cvmatdiv)>1) $cvmat=$cvmatdiv[0];
    $pdf->SetXY($x+1,$y);
    $pdf->MultiCell(20,6,mb_convert_encoding($cvmat,"ISO-8859-1","UTF-8"),1);
    $pdf->SetXY($x+21,$y);
    $pdf->MultiCell(15,6,mb_convert_encoding($dato["idG"],"ISO-8859-1","UTF-8"),1,'C'); 
    
    $pdf->SetXY($x+36,$y);   
    $pdf->MultiCell(109,6,$dato["mmateria"],1,'L',false);   

    $inscritos = $consulta->DatosAlumnototalGrupo($dato["idG"]);
    foreach($inscritos as $inscrito){
        $pdf->SetXY($x+145,$y);
        $pdf->MultiCell(23,6,mb_convert_encoding($inscrito["total"],"ISO-8859-1","UTF-8"),1,'C',false);
    }
    $inscritos = $consulta->DatosAlumnototalGrupoRealizado($dato["idG"]);
    foreach($inscritos as $inscrito){
        $pdf->SetXY($x+168,$y);
        $pdf->MultiCell(23,6,mb_convert_encoding($inscrito["total"],"ISO-8859-1","UTF-8"),1,'C',false);
    }
    $y+=6;
}
$pdf->cell(0,1," ",0,1);
$pdf->Cell(5);
$pdf->Cell(180,24,mb_convert_encoding('Aspectos a Evaluar',"ISO-8859-1","UTF-8"),0,0,'C');
$pdf->cell(0,18,'',0,1); 
$pdf->Cell(10);
$pdf->Cell(105,6,mb_convert_encoding('Aspectos evaluados',"ISO-8859-1","UTF-8"),1,0,'C');
$pdf->Cell(25,6,mb_convert_encoding('Puntaje',"ISO-8859-1","UTF-8"),1,0,'C');
$pdf->Cell(40,6,mb_convert_encoding('Calificación',"ISO-8859-1","UTF-8"),1,1,'C');
$promedios = $consulta->seccionpromedio($claveprofesor);
foreach($promedios as $promedio){
    $pdf->Cell(10);
    if ($promedio["seccion"] == 1){
        $texto='A) Dominio de la asignatura';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['A']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 2){
        $texto='B) Planificación de curso';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['B']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 3){
        $texto='C) Ambientes de aprendizaje';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['C']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 4){
        $texto='D) Estategias, métodos y técnicas';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['D']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 5){
        $texto='E) Motivación';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['E']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 6){
        $texto='F) Evaluación';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['F']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 7){
        $texto='G) Comunicación';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['G']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 8){
        $texto='H) Gestión de curso';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['H']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 9){
        $texto='I) Tecnologías de la información y comunicación';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['I']=$prom;
        $evafinal+=$prom;
    }
    elseif ($promedio["seccion"] == 10){
        $texto='J) Satisfacción general';
        $prom=number_format($promedio["promedio"],2,'.','');
        $arrecal['J']=$prom;
        $evafinal+=$prom;
        $evafinal/=10;
        $evafinal=number_format($evafinal,2,'.','');
    }
    if ($prom<=2.49){
        $caltexto='Insatisfactorio';
    }elseif ($prom>=2.5 && $prom<=3.49){
        $caltexto='Bien';
    }elseif ($prom>=3.5 && $prom<=4.49){
        $caltexto='Muy Bien';
    }elseif ($prom>=4.5 && $prom<=5){
        $caltexto='Excelente';
    }

    if ($evafinal<=2.49){
        $finaltexto='Insatisfactorio';
    }elseif ($evafinal>=2.5 && $evafinal<=3.49){
        $finaltexto='Bien';
    }elseif ($evafinal>=3.5 && $evafinal<=4.49){
        $finaltexto='Muy Bien';
    }elseif ($evafinal>=4.5 && $evafinal<=5){
        $finaltexto='Excelente';
    }

    $pdf->Cell(105,6,mb_convert_encoding($texto,"ISO-8859-1","UTF-8"),1,0,'L');
    $pdf->Cell(25,6,mb_convert_encoding($prom,"ISO-8859-1","UTF-8"),1,0,'C');
    $pdf->Cell(40,6,mb_convert_encoding($caltexto,"ISO-8859-1","UTF-8"),1,1,'C');   
}
    $pdf->Cell(10);
    $pdf->Cell(105,6,mb_convert_encoding('k) Promedio General',"ISO-8859-1","UTF-8"),1,0,'L');
    $pdf->Cell(25,6,mb_convert_encoding($evafinal,"ISO-8859-1","UTF-8"),1,0,'C');
    $pdf->Cell(40,6,mb_convert_encoding($finaltexto,"ISO-8859-1","UTF-8"),1,1,'C');
    $consulta->cerrar();
    $pdf->Image($img64,0,172,220,0,'png');
    //$pdf->Image(file,x,y,w,h,type);
    $nomarch="D".$claveprofesor.'.pdf';
    $pdf->Output('D',$nomarch,true);
?>