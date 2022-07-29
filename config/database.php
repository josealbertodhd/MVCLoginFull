<?php
    class database{
        public  static function conectar(){
            try {
                $conexion = new PDO('mysql:host=localhost;dbname=administracion_usuarios', 'root', '');
                //$conexion->query("SET NAMES 'utf8'");
                return $conexion;
           } catch (PDOException $e) {
                print "¡Error!: " . $e->getMessage() . "<br/>";
                die();
           }  
            
        }

    } 
?>