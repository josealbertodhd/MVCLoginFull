<?php
class UsuarioController {

    public $validarRegistro = true;

    public function mostrar(){
        require_once 'models/usuario.php';
        $usuarioc = new Usuario();
        $usuarios = $usuarioc->MostrarTodos('usuario');
        require_once 'views/usuario/mostrar.php';
    }

    public function crear(){
        require_once 'views/usuario/registro.html';
    }

    public function codigogenerado(){
        require_once 'models/usuario.php';
        $email = $_POST['email'];
        $username = $_POST['username'];
        $usuarioc = new Usuario();
        $usuarios = $usuarioc->validarCodigo($username, $email);
        $validarCodigo = $usuarioc->validarCodigo;
        if($validarCodigo == true){
            require_once 'views/usuario/codigo.html';
        }else{
            echo "Usuario o correo no registrados";
        }
    }

    public function recuperar(){
        require_once 'views/usuario/recuperar.html';
    }

    public function registrar(){
        require_once 'models/usuario.php';
        $identificacion = intval($_POST['identificacion']); 
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo'];
        $username = $_POST['user'];
        $programa = $_POST['programa'];
        $activo = 0;
        $salt = bin2hex(random_bytes(4));
        $password = password_hash($_POST['password'] , PASSWORD_BCRYPT);

        $this->validarCantidadStr(strlen($_POST['identificacion']), 0, '=', 
                $this->validarRegistro, "identificacion");
        $this->validarCantidadStr(strlen($_POST['identificacion']), 20, '>', 
                $this->validarRegistro, "identificacion");
        $this->validarCantidadStr(strlen($nombre), 0, '=', 
                $this->validarRegistro, "nombres");
        $this->validarCantidadStr(strlen($nombre), 100, '>', 
                $this->validarRegistro, "nombres");
        $this->validarCantidadStr(strlen($apellidos), 100, '>', 
                $this->validarRegistro, "apellidos");
        $this->validarCantidadStr(strlen($apellidos), 0, '=', 
                $this->validarRegistro, "apellidos");
        $this->validarCantidadStr(strlen($email), 150, '>', 
                $this->validarRegistro, "email");
        $this->validarCantidadStr(strlen($email), 0, '=', 
                $this->validarRegistro, "email");
        $this->validarCantidadStr(strlen($username), 20, '>', 
                $this->validarRegistro, "usuario");
        $this->validarCantidadStr(strlen($username), 6, '<', 
                $this->validarRegistro, "usuario");
        $this->validarCantidadStr(strlen($_POST['password']), 20, '>', 
                $this->validarRegistro, "contraseña");
        $this->validarCantidadStr(strlen($_POST['password']), 6, '<', 
                $this->validarRegistro, "contraseña");
        
        if($this->validarRegistro == true){
            $usuarioc = new Usuario();
            $usuariosc = $usuarioc->Guardar($identificacion, $nombre, $apellidos, $email, 
                                        $tipo, $username, $password, $programa, $activo);
            require_once 'views/usuario/registrar.php';
        }     
    }

    public function mostrarl(){
        require_once 'models/usuario.php';
        $usuarioc = new Usuario();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usuarios = strval($usuarioc->validarLogin($password, $username));
        if($usuarios == "El usuario es un profesor" ||
             $usuarios == "El usuario es un Administrativo"){
                header('Location: routes.php?controller=Acta&action=crear');
        }else{
                require_once 'index.html';
                echo "<script>alert(\"Credenciales Invalidas\");</script>";               
        }
        
    }

    public function validarCantidadStr($valor, $cantidad, $propiedad,
                                        $validarRegistro, $atributo): void{
        if($propiedad == '='){
            if($valor == $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es igual a " . $cantidad;
                header('Location: routes.php?controller=Usuario&action=crear');
            }
        }else if($propiedad == '>'){
            if($valor > $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es mayor a " . $cantidad;
                header('Location: routes.php?controller=Usuario&action=crear');
            }
        }else{
            if($valor < $cantidad){
                $this->validarRegistro = false;
                $atributo = "La cantidad de elementos de " . $atributo . " es menor a " . $cantidad;
                header('Location: routes.php?controller=Usuario&action=crear');
            }
        }
    }
}
?>