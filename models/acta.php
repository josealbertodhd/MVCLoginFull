<?php
require_once 'modelobase.php';
Class Acta extends ModeloBase{
        
    public $programa;
    public $asunto;
    public $fechaActa;
    public $descripcionActa;
    public $responsableActa;

    public function __construct(){
        //herede la conexion a bd
        parent::__construct();
    }

    public function saveActa($programa, $asunto, $fechaActa, 
                                $descripcionActa, $responsableActa){

        $conexion = $this->db;
        $sql = "INSERT INTO acta
        (asunto, fecha_acta, descripcion_acta, responsable_acta, programa_id) 
        VALUES
        (?, ?, ?, ?, ?)";
        $sths = $conexion->prepare($sql);
        $sths->bindParam(1, $asunto, PDO::PARAM_STR);
        $sths->bindParam(2, $fechaActa, PDO::PARAM_STR);
        $sths->bindParam(3, $descripcionActa, PDO::PARAM_STR);
        $sths->bindParam(4, $responsableActa, PDO::PARAM_STR);
        $sths->bindParam(5, $programa, PDO::PARAM_INT);

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