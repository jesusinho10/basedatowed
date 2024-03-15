<?php
// Define la clase Database.
class Database
{
    // Propiedades privadas para configurar la conexión a la base de datos.
    private $host = "localhost"; // Host de la base de datos.
    private $port = "3306"; // Puerto por el cual se conecta la base de datos.
    private $db_name = "grupo_jueves"; // Nombre de la base de datos a la que se quiere conectar.
    private $username = "root"; // Nombre de usuario para acceder a la base de datos.
    private $password = ""; // Contraseña para el usuario especificado.
    
    // Propiedad pública que almacenará la conexión a la base de datos.
    public $conn;

    // Método para obtener la conexión a la base de datos.
    public function getConnection()
    {
        // Inicializa la propiedad conn como null para asegurar que esté limpia antes de intentar una nueva conexión.
        $this->conn = null;
        try {
            // Intenta crear una nueva conexión PDO con los datos proporcionados.
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            
            // Configura la conexión para usar la codificación UTF-8, asegurando que los caracteres especiales se manejen correctamente.
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            // En caso de error en la conexión, captura la excepción y muestra el mensaje de error.
            echo "Error de conexión: " . $exception->getMessage();
        }
        // Retorna la conexión a la base de datos, que puede ser null si la conexión falló.
        return $this->conn;
    }
}
