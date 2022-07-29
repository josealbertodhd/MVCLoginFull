<?php
    require_once 'modelobase.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    require 'C:\xampp\htdocs\MVCLogin\vendor\autoload.php';

    Class Usuario extends ModeloBase{
        
        public $identificacion;
        public $nombres;
        public $apellidos;
        public $email;
        public $password;
        public $username;
        public $tipo_user;
        public $programa;
        public $activo;
        public $validarCodigo = false;

        public function __construct(){
            //herede la conexion a bd
            parent::__construct();
        }
        public function GetIdentificacion(){
            return $this->identificacion;
        }
        public function SetIdentificacion(int $identificacion){
            $this->identificacion =  $identificacion;
        }
        public function GetNombre(){
            return $this->nombres;
        }
        public function SetNombre(string $nombres){
            $this->nombres =  $nombres;
        }

        public function GetApellido(){
            return $this->apellidos;
        }
        public function SetApellido(string $apellidos){
            $this->apellidos =  $apellidos;
        }

        public function GetEmail(){
            return $this->email;
        }
        public function SetEmail(string $email){
            $this->email =  $email;
        }

        public function GetPass(){
            return $this->pass;
        }
        public function SetPass(string $pass){
            $this->pass =  $pass;
        }
        public function GetUsername(){
            return $this->username;
        }
        public function SetUsername(string $username){
            $this->username =  $username;
        }
        public function GetTipoUser(){
            return $this->tipo_user;
        }
        public function SetTipoUser(string $tipo_user){
            $this->tipo_user =  $tipo_user;
        }
        public function GetPrograma(){
            return $this->programa;
        }
        public function SetPrograma(string $programa){
            $this->programa =  $programa;
        }
        public function GetActivo(){
            return $this->activo;
        }
        public function SetActivo(string $activo){
            $this->activo =  $activo;
        }

        public function saveUser($conexion, $identificacion, $nombre, $apellidos, $email, 
        $tipo, $username, $password, $programa, $activo){
            
            $sql = "INSERT INTO usuario
            (identificacion, nombres, apellidos, email, tipo_user, username, password, programa, activo) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sths = $conexion->prepare($sql);
            $sths->bindParam(1, $identificacion, PDO::PARAM_INT);
            $sths->bindParam(2, $nombre, PDO::PARAM_STR);
            $sths->bindParam(3, $apellidos, PDO::PARAM_STR);
            $sths->bindParam(4, $email, PDO::PARAM_STR);
            $sths->bindParam(5, $tipo, PDO::PARAM_STR);
            $sths->bindParam(6, $username, PDO::PARAM_STR);
            $sths->bindParam(7, $password, PDO::PARAM_STR);
            $sths->bindParam(8, $programa, PDO::PARAM_STR);
            $sths->bindParam(9, $activo, PDO::PARAM_INT);

            if(!$sths->execute()){
                echo "Error al ejecutar la consulta";
                exit;
            }else{
                echo "Datos registrados";
            }
            return $sths;        
        } 

        public function Guardar($identificacion, $nombre, $apellidos, $email, 
                                $tipo, $username, $password, $programa, $activo){

             $validar = true;
             $cadena = "consulta";
             $sql = "SELECT username, identificacion FROM usuario";
             $conexion = $this->db;
             $sth = $conexion->prepare($sql);
             if(!$sth->execute()){
             $error = "Error al ejecutar la consulta";
             exit;
             }else{
                 $sth->execute();
                 $count=$sth->rowCount(); 
                 if ($count == 0){
                    $sths = $this->saveUser($conexion, $identificacion, $nombre, $apellidos, $email, 
                    $tipo, $username, $password, $programa, $activo);
                    $this->sendEmail($email, $nombre, false, null);
                    $error = "Consulta realizada con exito";
                 }else{
                     foreach ($sth as $fila) {
                        if ($username == $fila['username']){
                            $cadena = "username";
                            break;
                        }elseif($identificacion == $fila['identificacion']){
                            $cadena = "identificacion";
                            break;
                        }
                     }
                     if ($cadena == "consulta") {
                        $sths = $this->saveUser($conexion, $identificacion, $nombre, $apellidos, $email, 
                                     $tipo, $username, $password, $programa, $activo);
                                     $this->sendEmail($email, $nombre, false, null);
                                     $error = "Consulta realizada con exito";
                     }elseif ($cadena == "username") {
                        echo "<script>alert(\"Usuario ya existe\");</script>";
                        header('Location: routes.php?controller=Usuario&action=crear');
                     }else{
                        echo "<script>alert(\"Identificacion ya existe\");</script>";
                        header('Location: routes.php?controller=Usuario&action=crear');
                     }    
                 }         
             }     
         return $error;
        }

        public function validarLogin($password, $username ){
            $cadena = "";
            $sql = "SELECT tipo_user, username, password FROM usuario WHERE (username = ?)";
            $sth = $this->db->prepare($sql);
            $sth->bindParam(1, $username, PDO::PARAM_STR);
            if(!$sth->execute()){
                $cadena = "Error al ejecutar la consulta";
                exit;
            }else{
                $sth->execute();
                foreach ($sth as $fila) {
                    if (password_verify($password , $fila['password'])) {
                        if ($fila['tipo_user'] == "Profesor") {
                             $cadena = "El usuario es un profesor";
                        }else {
                             $cadena = "El usuario es un Administrativo";
                        }
                    }else{
                        $cadena = "Credenciales invalidas";
                    }     
                }
            }
            return $cadena;
        }

        public function sendEmail($email, $nombre, $atributo, $contrasena){

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
       
            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Username = 'towermass.net@gmail.com';
            $mail->Password = 'mwzivcjmfffcgohi';
            $mail->setFrom('towermass.net@gmail.com', 'Jose Alberto De Hoyos');
            $mail->addAddress($email, $nombre);
            $mail->Subject = 'Inicio de Sesion';
            $mensaje = "<h1> Bienvenido a nuestra Plataforma </h1>
            <a href='https://www.youtube.com/'>Haga click en el enlace para acceder a nuestra pagina</a>";
            if ($atributo == true){
                $mail->Subject = 'Recuperacion de Contrasena';
                $mensaje = "<h1> Bienvenido a nuestra Plataforma </h1>
                 <a href='http://localhost/MVCLogin/routes.php?controller=Usuario&action=codigogenerado'>Su codigo de recuperacion es: ". $contrasena . " </a>";
            }
            
       
            $mail->msgHTML($mensaje);
            $mail->AltBody = 'This is a plain-text message body';
       
            if (!$mail->send()) { 
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message sent!';
                //Section 2: IMAP
                //Uncomment these to save your message in the 'Sent Mail' folder.
                #if (save_mail($mail)) {
                #    echo "Message saved!";
                #}
            }
       }

       public function validarCodigo($username, $email){
        $cadena = "";
        $sql = "SELECT email, username FROM usuario WHERE (username = ?) AND (email = ?)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(1, $username, PDO::PARAM_STR);
        $sth->bindParam(2, $email, PDO::PARAM_STR);
        if(!$sth->execute()){
            $cadena = "Error al ejecutar la consulta";
            exit;
        }else{
            $sth->execute();
            $count=$sth->rowCount(); 
            if($count > 0){
                $sqls = "UPDATE usuario SET password = ? WHERE username = ?";
                $sths = $this->db->prepare($sqls);
                $contrasenaGenerada = strval(random_int(100000, 999999));
                $sths->bindParam(1, $contrasenaGenerada, PDO::PARAM_STR);
                $sths->bindParam(2, $username, PDO::PARAM_STR);
                $sths->execute();
                $this->sendEmail($email, $username, true, $contrasenaGenerada);
                $cadena = "Codigo Generado";
                $this->validarCodigo = true;
            }else{
                $cadena = "Codigo no ha sido generado";
            }
        }
        return $cadena;
       }
    }

?>