<?php
session_start();
$matricula = $_SESSION['matr'];
require_once("clases/autoload.php");

$consulta = new Consultasr();
if ($consulta->RegistrarResultado($_POST, $matricula)) {
    $consulta->cerrar();
    header("location:completado.php");
}
