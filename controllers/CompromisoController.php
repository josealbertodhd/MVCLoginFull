<?php
class CompromisoController {

    public $validarRegistro = true;

    public function crear(){
        require_once 'views/compromiso/crearCompromiso.php';
    }

    public function registrar(){
        require_once 'models/compromiso.php';
        $descripcion_compromiso = $_POST['descripcion_compromiso'];
        $fecha_inicio = $_POST['fecha_inicial'];
        $fecha_final = $_POST['fecha_final'];
        $responsable_compromiso = $_POST['responsable_compromiso'];  

        $this->validarCantidadStr(strlen($descripcion_compromiso), 7, '<', 
                $this->validarRegistro, "descripcion de compromiso");
        $this->validarCantidadStr(strlen($fecha_inicio), 0, '=', 
                $this->validarRegistro, "fecha inicio");
        $this->validarCantidadStr(strlen($fecha_final), 0, '=', 
                $this->validarRegistro, "fecha final");
        $this->validarCantidadStr(strlen($responsable_compromiso), 6, '<', 
                $this->validarRegistro, "responsable de compromiso");
        $fila = intval($_GET['fila']); 

        if($this->validarRegistro == true){
            $compromisoc = new Compromiso();
            $compromisos = $compromisoc->saveCompromiso($fila, $descripcion_compromiso, $fecha_inicio, 
                                            $fecha_final, $responsable_compromiso);
            require_once 'views/compromiso/registrarCompromiso.php';
        }     
    }

    public function validarCantidadStr($valor, $cantidad, $propiedad,
                                        $validarRegistro, $atributo): void{
        if($propiedad == '='){
            if($valor == $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es igual a " . $cantidad;
                header('Location: routes.php?controller=Compromiso&action=crear');
            }
        }else if($propiedad == '>'){
            if($valor > $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es mayor a " . $cantidad;
                header('Location: routes.php?controller=Compromiso&action=crear');
            }
        }else{
            if($valor < $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es menor a " . $cantidad;
                header('Location: routes.php?controller=Compromiso&action=crear');
            }
        }
    }

}
?>