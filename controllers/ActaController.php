<?php
class ActaController {

    public $validarRegistro = true;

    public function crear(){
        require_once 'views/acta/crear.html';
    }

    public function mostrar(){
        require_once 'models/acta.php';
        $actac = new Acta();
        $actas = $actac->MostrarTodos('acta');
        require_once 'views/acta/mostrarActas.php';
    }

    public function registrar(){
        require_once 'models/acta.php';
        $programa = intval($_POST['programa']);
        $asunto = $_POST['asunto'];
        $fechaActa = $_POST['fecha_acta'];
        $descripcionActa = $_POST['descripcion_acta'];
        $responsableActa = $_POST['responsable_acta'];
        $this->validarCantidadStr(strlen($fechaActa), 0, '=', 
                $this->validarRegistro, "fecha de acta");
        $this->validarCantidadStr(strlen($asunto), 5, '<', 
                $this->validarRegistro, "asunto");
        $this->validarCantidadStr($programa, 0, '=', 
                $this->validarRegistro, "programa");
        $this->validarCantidadStr(strlen($descripcionActa), 5, '<', 
                $this->validarRegistro, "descripcion de acta");
        $this->validarCantidadStr(strlen($responsableActa), 5, '<', 
                $this->validarRegistro, "responsable de acta");
        
        if($this->validarRegistro == true){
            $actac = new Acta();
            $actasc = $actac->saveActa($programa, $asunto, $fechaActa, 
                                            $descripcionActa, $responsableActa);
            header('Location: routes.php?controller=Acta&action=mostrar');
        }     
    }

    public function validarCantidadStr($valor, $cantidad, $propiedad,
                                        $validarRegistro, $atributo): void{
        if($propiedad == '='){
            if($valor == $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es igual a " . $cantidad;
                header('Location: routes.php?controller=Acta&action=crear');
            }
        }else if($propiedad == '>'){
            if($valor > $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es mayor a " . $cantidad;
                header('Location: routes.php?controller=Acta&action=crear');
            }
        }else{
            if($valor < $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es menor a " . $cantidad;
                header('Location: routes.php?controller=Acta&action=crear');
            }
        }
    }

}
?>