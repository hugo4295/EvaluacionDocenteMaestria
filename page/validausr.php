<?php
session_start();

if (isset($_POST['matricula'])){
	$matriii = $_POST['matricula'];
	//echo var_dump($matriii);
	 if ($matriii == '') {
		echo "<script>alert('error! no hay valores!')</script>";
	}
	else {
		require_once("clases/autoload.php");
		$db = new Consultasr();
		if($db->validarusua($matriii)) {			
			 $_SESSION['matr']=$matriii;	
			if ($_SESSION["sta"] === 'N') {
				//echo " entra en N";
				header("location:contesta.php");
			}
			elseif ($_SESSION["sta"] === 'R') {
				header("location:completado.php");
				echo "entra en R";
			} 
		}
		else {
			echo "no existe el registro";	
		}
	} 
}else {
	echo "<script>alert('Error! no hay valores!')</script>";
}
?>
