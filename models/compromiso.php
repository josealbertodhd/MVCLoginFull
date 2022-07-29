<?php
require_once 'modelobase.php';
Class Compromiso extends ModeloBase{
        
    public $descripcion_compromiso;
    public $fecha_final;
    public $fecha_inicio;
    public $responsable_compromiso;
    public $acta_id;

    public function __construct(){
        //herede la conexion a bd
        parent::__construct();
    }

    public function saveCompromiso($acta_id, $descripcion_compromiso, $fecha_inicio, 
                                $fecha_final, $responsable_compromiso){

        $conexion = $this->db;
        $sql = "INSERT INTO compromisos
        (descripcion_compromiso, fecha_inicio, fecha_final, responsable_compromiso, acta_id) 
        VALUES
        (?, ?, ?, ?, ?)";
        $sths = $conexion->prepare($sql);
        $sths->bindParam(1, $descripcion_compromiso, PDO::PARAM_STR);
        $sths->bindParam(2, $fecha_inicio, PDO::PARAM_STR);
        $sths->bindParam(3, $fecha_final, PDO::PARAM_STR);
        $sths->bindParam(4, $responsable_compromiso, PDO::PARAM_STR);
        $sths->bindParam(5, $acta_id, PDO::PARAM_INT);

        if(!$sths->execute()){
            echo "Error al ejecutar la consulta";
            exit;
        }else{
            echo "Datos registrados";
        }
        return $sths;        
    } 
}
?>