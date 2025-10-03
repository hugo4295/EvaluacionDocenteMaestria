<?php
require_once("autoload.php");
//se crean las consultas y vistas necesarias para procesar los datos
// create view gpm as SELECT p.nombre, m.nombre AS 'Materia', gpm.claveProf, g.idG FROM grupoprofesormateria gpm INNER JOIN grupo g ON g.idG = gpm.idG INNER JOIN materia m ON m.claveMat = gpm.claveMat INNER JOIN profesor p ON p.claveProf = gpm.claveProf;
class Consultasr
{
    private $miconexion;

    public function __construct()
    {
        $this->miconexion = new Conexion();
        $this->miconexion = $this->miconexion->AbrirConexion();
    }

    public function CargaPreguntas()
    {
        $sql = 'SELECT numP, preg FROM pregunta';
        $consulta = $this->miconexion->prepare($sql);
        $consulta->execute();
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function Cargargpm($idg)
    {
        $sql = "select * from  gpm where idG = :idg order by idG";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->BindValue(":idg", $idg);
        $consulta->execute();
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    // se insertan los datos se genera de los arreglos para poder obtener los datos en forma masiva
    // se insertan los elementos y obtenermos los id de control
    // se realizan el inicio de transaccion y se insertan los datos
    //
    // Los datos de la pregunta 26 (Comentarios para el profesor) no se insertan, y desde la $post no
    // los jala adecuadamente
    public function RegistrarResultado(array $post, $matricula)
    {
        $periodo = $post["periodo"];
        $totalprofesores = $post["totalprofes"];
        $idregistrado=[];
        $cveprofesor=[];

        for ($i = 1; $i <= $totalprofesores; $i++) {
            $armaclave = "claveprofesor" . $i;
            $claveprofesor = $post[$armaclave];
            $cveprofesor[] = $claveprofesor;
            $sql = "insert into encuestaconteo (periodo, claveProf) values (:periodo,:claveprofesor)";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->BindValue(":periodo", $periodo);
            $consulta->BindValue(":claveprofesor", $claveprofesor);
            $consulta->execute();

            $idrecuperado = $this->miconexion->lastInsertId();
            //echo "id recuperado: " . $idrecuperado . "<br>";
            $idregistrado[] = $idrecuperado;
        }        
        // se arma el arreglo para poder insertar los datos de las preguntas con los id de control
        $EP=[];
        $E=[];
        $PE=[];
        for ($i = 1; $i <= $totalprofesores; $i++) {
            for ($p = 1; $p <= 26; $p++) { // Establece numero de preguntas manualmente
                $Pr = "p" . $p . $i;
                $pe = $post[$Pr];
                $EP[]=[$idregistrado[$i-1],$p,$pe]; // Los datos de p26 no se insertan.
            }
            $E[]=[$idregistrado[$i-1],$periodo];
            $PE[]=[$cveprofesor[$i-1],$idregistrado[$i-1]];
        }

        $VEP="insert into encuestapregunta(idE, numP, evaluacion) values (".$EP[0][0].",".$EP[0][1].",".$EP[0][2].")";
        $VEC="insert into encuestacomentario(idE,comentario) values(".$EP[0][0].",NULL)";
        foreach ($EP as $key => $value) {
            if($key==0)continue;
            if($value[1]==26){
                $VEC.=","."(".$value[0].",'".$value[2]."')";
            }else{
                $VEP.=","."(".$value[0].",".$value[1].",".$value[2].")";
            }
        }
        $VE="insert into encuesta(idE, periodo) values (".$E[0][0].",".$E[0][1].")";
        foreach ($E as $key => $value) {
            if ($key > 0) {
                $VE.=","."(".$value[0].",'".$value[1]."')";
            }
        }
        $VPE="insert into profesorencuesta(claveProf,idE) values (".$PE[0][0].",'".$PE[0][1]."')";
        foreach ($PE as $key => $value) {
            if ($key > 0) {
                $VPE.=","."(".$value[0].",".$value[1].")";
            }
        }
        $this->miconexion->beginTransaction();
        try {
            $this->miconexion->exec($VEP);
            $this->miconexion->exec($VE);
            $this->miconexion->exec($VPE);
            $this->miconexion->exec($VEC);
            $this->miconexion->commit();
        } catch (Exception $e) {
            $this->miconexion->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
        // se actualiza el estatus del encuestado
        $result = $this->miconexion->prepare("UPDATE encuestado SET status = 'R' WHERE matricula = :matricula");
        $result->BindValue(":matricula", $matricula);
        $result->execute();
        return true;
    }

    public function validarusua($matriii){
        $sql="SELECT e.matricula, e.status, g.idG FROM encuestado e, encuestadogrupo g WHERE e.matricula = :matriii and e.matricula = g.matricula";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->BindValue(":matriii", $matriii);
        $consulta->execute();
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $_SESSION['matr'] = $row["matricula"];
            $_SESSION["sta"] = $row["status"];
            $_SESSION["grup"] = $row["idG"];
            return true;
        } else {
            return false;
            }
    }

    public function cerrar()
    {
        $this->miconexion = null;
    }
}
