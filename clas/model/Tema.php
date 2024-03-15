<?php

// Incluye el archivo que define la clase Database para poder usarla para la conexión a la base de datos.
require_once 'Database.php';

// Definición de la clase Tema.
class Tema {
    // Propiedad privada para mantener la conexión a la base de datos.
    private $conn;
    // Nombre de la tabla con la que esta clase interactuará en la base de datos.
    private $table_name = "temas";

    // Propiedades públicas que representan los campos de la tabla.
    public $id;
    public $nombre;
    public $descripcion;
    public $tipo;
    public $activo;

    // Constructor de la clase. Se conecta a la base de datos al instanciar un objeto de esta clase.
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para leer todos los registros de la tabla 'temas'.
    function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para leer un solo registro de la tabla 'temas' basado en el ID.
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    

    // Método para crear un nuevo registro en la tabla 'temas'.
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion, tipo=:tipo, activo=:activo";
        $stmt = $this->conn->prepare($query);

        // Asignación de los valores de las propiedades al comando SQL a través de bindParam.
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":activo", $this->activo);

        // Ejecuta el comando SQL y retorna verdadero si es exitoso.
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para actualizar un registro en la tabla 'temas' basado en el ID.
    function update() {
        $query = "UPDATE " . $this->table_name . " SET nombre = :nombre, descripcion = :descripcion, tipo = :tipo, activo = :activo WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Asignación de valores y ejecución del comando SQL.
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':activo', $this->activo);
        $stmt->bindParam(':id', $this->id);

        // Retorna verdadero si la ejecución es exitosa.
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para eliminar un registro en la tabla 'temas' basado en el ID.
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        // Ejecuta el comando SQL y retorna verdadero si es exitoso.
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
