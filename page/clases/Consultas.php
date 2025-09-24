<?php
require_once("autoload.php");
//se crean las consultas y vistas necesarias para procesar los datos
// create view gpm as SELECT p.nombre, m.nombre AS 'Materia', gpm.claveProf, g.idG FROM grupoprofesormateria gpm INNER JOIN grupo g ON g.idG = gpm.idG INNER JOIN materia m ON m.claveMat = gpm.claveMat INNER JOIN profesor p ON p.claveProf = gpm.claveProf;
class Consultas
{
    private $miconexion;

    public function __construct()
    {
        $this->miconexion = new Conexion();
        $this->miconexion = $this->miconexion->AbrirConexion();
    }

    public function CargarPeriodo()
    {
        $sql = 'SELECT periodo FROM Periodo WHERE activo="A"';
        $consulta = $this->miconexion->prepare($sql);
        $consulta->execute();
        $registro = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($registro) {
            return (string)$registro['periodo'];
        } else {
            return ''; // o null
        }
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
        $sql = "select * from gpm where idG = :idg order by idG";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->BindValue(":idg", $idg);
        $consulta->execute();
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function RegistrarResultado(array $post, $matricula)
    {
        $periodo = $post["periodo"];
        $totalprofesores = $post["totalprofes"];
        for ($i = 1; $i <= $totalprofesores; $i++) {
            $armaclave = "claveprofesor" . $i;
            $claveprofesor = $post[$armaclave];
            $sql = "insert into encuestaconteo (periodo, claveProf) values (:periodo,:claveprofesor)";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->BindValue(":periodo", $periodo);
            $consulta->BindValue(":claveprofesor", $claveprofesor);
            $consulta->execute();

            $idrecuperado = $this->miconexion->lastInsertId();

            for ($p = 1; $p <= 48; $p++) {
                $Pr = "p" . $p . $i;
                $pe = $post[$Pr];
                $registracalificacion = "insert into encuestapregunta(idE, numP, evaluacion) values (:idrecuperado,:p,:pe)";
                $resregcalif = $this->miconexion->prepare($registracalificacion);
                $resregcalif->BindValue(":idrecuperado", $idrecuperado);
                $resregcalif->BindValue(":p", $p);
                $resregcalif->BindValue(":pe", $pe);
                $resregcalif->execute();
            }
            $back = "insert into encuesta(idE, periodo) values (:idrecuperado,:periodo)";
            $backuse = $this->miconexion->prepare($back);
            $backuse->BindValue(":idrecuperado", $idrecuperado);
            $backuse->BindValue(":periodo", $periodo);
            $backuse->execute();

            $profesorEncuesta = "insert into profesorencuesta(claveProf,idE) values(:claveprofesor,:idrecuperado)";
            $llenadoEncuesta = $this->miconexion->prepare($profesorEncuesta);
            $llenadoEncuesta->BindValue(":claveprofesor", $claveprofesor);
            $llenadoEncuesta->BindValue(":idrecuperado", $idrecuperado);
            $llenadoEncuesta->execute();
        }
        $result = $this->miconexion->prepare("UPDATE encuestado SET status = 'R' WHERE matricula = :matricula");
        $result->BindValue(":matricula", $matricula);
        $result->execute();
        return true;
    }

    public function cerrar()
    {
        $this->miconexion = null;
    }
}
