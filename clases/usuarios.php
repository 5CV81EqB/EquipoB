<?php
include("config.inc.php");
include_once("database.php");
@session_start();
class usuarios extends DATABASE{
    protected $usuario_id = NULL;
    protected $perfil_id = NULL;
    protected $usuario_user = NULL;
    protected $usuario_nombre = NULL;

    private $usuario_password = NULL;
    private $usuario_session = NULL;
    private $usuario_accesos = NULL;

    function __construct() {
        if(isset($_SESSION["usuario_id"])){
            $this->usuario_id=$_SESSION["usuario_id"];
        }
        parent::__construct();
}

public function login($user, $password) {
    $this->usuario_user = $user;
    $this->usuario_password = $password;
    if($this->isUserValid($this->usuario_user, $this->usuario_password)) {
        $this->setSession();
        return TRUE;
    } //if

    return FALSE;
} 

private function isUserValid($user, $password) {
    // Consulta el usuario
 
            if(($user === "admin" && $password === "admin") || ($user === "gerente" && $password === "gerente")) {
                $this->setUserData($user,$password);
                return TRUE;
            }

    return FALSE;
}
private function setUserData($user,$password) {
   switch($user){
    case "admin":{
        $this->usuario_id = $user;
        $this->perfil_id = 1;
        $this->usuario_user = "admin";
        $this->usuario_nombre = "administrador";
        $this->usuario_password = $password;
        $this->usuario_session = NULL;
        $this->usuario_accesos=1;
    }
    break;
    case("gerente"):{
        $this->usuario_id = $user;
        $this->perfil_id = 1;
        $this->usuario_user = "gerente";
        $this->usuario_nombre = "Gerente";
        $this->usuario_password = $password;
        $this->usuario_session = NULL;
        $this->usuario_accesos=2;
    }
    break;
   }
}

private function setSession() {
    // Crea nueva sesión en My
    //@session_start();
    $this->usuario_session = session_id();

    // Variables de sesión
    $_SESSION['usuario_id'] = $this->usuario_id;
    $_SESSION['perfil_id'] = $this->perfil_id;
    $_SESSION['usuario_nombre'] = $this->usuario_nombre;
    $_SESSION['usuario_user'] = $this->usuario_user;
    $_SESSION['usuario_sesion'] = $this->usuario_session;
    $_SESSION['usuario_accesos'] = $this->usuario_accesos;

    // Establece valores de sesión en navegador
    setcookie("session_u", $this->usuario_user, COOKIE_TIME, "/", DOMINIO);
    setcookie("session_p", $this->usuario_password, COOKIE_TIME, "/", DOMINIO);
    setcookie("session_remember", 'true', COOKIE_TIME, "/", DOMINIO);
}

private function destroyCookieSession() {
    setcookie("session_u", '', -(COOKIE_TIME), "/", DOMINIO, true, true);
    setcookie("session_p", '', -(COOKIE_TIME), "/", DOMINIO, true, true);
    setcookie("session_remember", '', -(COOKIE_TIME), "/", DOMINIO, true, true);
    unset($_COOKIE['session_u']);
    unset($_COOKIE['session_p']);
    unset($_COOKIE['session_remember']);
}
private function destroySession() {
    session_unset();
    session_destroy();
}
public function logout(){
    $this->destroySession();
    $this->destroyCookieSession();
} 

}
?>
