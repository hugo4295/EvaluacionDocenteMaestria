<?php
require_once("autoload.php");
//vista para obtener datos del profesor y grupos
// create view datosprofmat as select m.claveMat,m.nombre mmateria,p.nombre mprofesor,gpm.idG, p.claveProf from profesor p inner join grupoprofesormateria gpm on p.claveProf=gpm.claveProf inner join materia m on gpm.claveMat= m.claveMat;
//vista total alumnos realizados y total por grupo
//create view alumnostotalenc as select eg.matricula matricula,eg.idG grupo ,e.status estado from encuestadogrupo eg inner join encuestado e on eg.matricula = e.matricula;
// vista datosprofmat
// create view datosprofmat as select m.claveMat,m.nombre mmateria,p.nombre mprofesor,gpm.idG, p.claveProf from profesor p inner join grupoprofesormateria gpm on p.claveProf=gpm.claveProf inner join materia m on gpm.claveMat= m.claveMat;

class Consultas{
    private $miconexion;

    public function __construct(){
        $this->miconexion = new Conexion();
        $this->miconexion = $this->miconexion->AbrirConexion();
    }

    public function DatosDocente($claveprof){
        $sql="Select * From datosprofmat where claveProf = :claveProf";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->bindParam(':claveProf', $claveprof);
        $consulta->execute();
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public function DatosAlumnototalGrupo($grupo){
        $sql="select count(estado) total from alumnostotalenc where grupo = :grupo";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->BindValue(":grupo", $grupo);
        $consulta->execute();
        $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
    }

    public function DatosAlumnototalGrupoRealizado($grupo){
        $sql="select count(estado) total from alumnostotalenc where grupo = :grupo and estado = 'R'";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->BindValue(":grupo", $grupo);
        $consulta->execute();
        $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
    }

    public function seccionpromedio($claveprof){
        $sql="select pe.claveProf,p.secc seccion, AVG(ep.evaluacion) promedio from encuestapregunta ep inner join pregunta p on p.numP = ep.numP inner join encuesta e on e.idE = ep.idE inner join profesorencuesta pe on pe.idE = e.idE where pe.claveProf=:claveProf group by seccion";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->BindValue(":claveProf", $claveprof);
        $consulta->execute();
        $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
    }

    public function Profesores(){
        $sql="Select distinct(claveProf),mprofesor From datosprofmat";
        $consulta = $this->miconexion->prepare($sql);
        $consulta->execute();
        $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
    }

    public function cerrar(){
        $this->miconexion=null;
    }
}
?>