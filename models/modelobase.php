<?php
    require_once 'config/database.php';
    class ModeloBase{
        public $db;
        public function __construct(){
            //conexion a db
            $this->db = database::conectar();

        }
        public function MostrarTodos($tabla){
           //var_dump ($this->db); 
            $query = $this->db->prepare("SELECT * FROM $tabla");
            $query->execute();
            return $query;
        }
    }
?>