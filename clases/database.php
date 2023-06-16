<?php
$server = ini_get('mysqli.default_host');
if(!defined('SERVER')) define("SERVER", !empty($server) ? $server : '127.0.0.1');
//Nombre de usuario
$db_user = ini_get('mysqli.default_user');
if(!defined("DB_USER")) define("DB_USER", !empty($db_user) ? $db_user : 'root');
//Contraseña de acceso
$db_pw = ini_get('mysqli.default_pw');
if(!defined("PASSWORD")) define("PASSWORD", !empty($db_pw) ? $db_pw : NULL);


class DATABASE{
    protected $conexMySQL = NULL;
    private $driver = NULL;
    private $sql = NULL;
    private $results = NULL;
    /* Constructor
        Inicia la conexion a la base de datos
    */
    function __construct($server = SERVER, $user = DB_USER, $password = PASSWORD, $database = DATABASE, $port = 3306) {
        $this->driver = new mysqli_driver();
        $this->driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
        // Verifica acceso al servidor conexMySQL
        $this->conexMySQL = new mysqli($server, $user, $password, $database, $port);
        if ($this->conexMySQL->connect_errno) {
            throw new Exception("Error de conexion: %s\n", $this->conexMySQL->connect_error);
        } //if
    } 
    /* Destructor
        Cierra la conexion a la base de datos
    */
    function __destruct() {
        if(!is_null($this->conexMySQL))
            $this->conexMySQL->close();
        $this->driver->report_mode = MYSQLI_REPORT_OFF;
    }
    public function __get($fieldname) {
        switch($fieldname) {
            case 'ConexDB': return $this->conexMySQL;
        } //switch

        $trace = debug_backtrace();
        throw new Exception(
            'Undefined property via __get(): ' . $fieldname .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    public function error() {
        $error = print_r($this->conexMySQL->error, TRUE);
        $errno = $this->conexMySQL->errno;
        return "Code: $errno -> SQL: $this->sql --> Error: $error";
    }
    /* Funcion query
        aqui es donde se realizan las operaciones sql y devuelve el valor obtenido
    */
    public function query($sql) {
        $this->sql = trim($sql);
        if($this->debug) trigger_error($this->sql);
        $this->results = $this->conexMySQL->query($this->sql);
        if($this->conexMySQL->error) {
            trigger_error($this->error());
            throw new Exception($this->error(), $this->conexMySQL->errno);
        } //if

        return $this->results;
    }
}
?>