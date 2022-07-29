<?php
require_once 'modelobase.php';
Class ReporteCompromiso extends ModeloBase{
        
    public $acta_id;

    public function __construct(){
        //herede la conexion a bd
        parent::__construct();
    }

    public function mostrarReporteCompromiso($acta_id){

        $conexion = $this->db;
        $sql = "SELECT * FROM compromisos WHERE acta_id=?";
        $sths = $conexion->prepare($sql);
        $sths->bindParam(1, $acta_id, PDO::PARAM_INT);

        if(!$sths->execute()){
            echo "Error al ejecutar la consulta";
            exit;
        }
        return $sths;        
    } 
}
?>