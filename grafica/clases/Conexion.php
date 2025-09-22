<?php
require_once "../config/config.php";
class Conexion{

    private $db=DB_DATABASE;
    private $host=DB_HOST;
    private $usr=DB_USER;
    private $pwd=DB_PASSWORD;
    private $conecta;

    public function __construct(){
        $cadena="mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
        try{
            $this->conecta=new PDO($cadena,$this->usr,$this->pwd);
            $this->conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            $this->conecta="Error de conexion";
            echo "Error: ".$e->getMessage();
        }
    } 
    
    public function AbrirConexion(){
        return $this->conecta;
    }

    public function CerrarConexion(){
        $this->conecta=null;
    }
    
}
?>
