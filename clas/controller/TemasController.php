<?php 
// Requiere el archivo de configuración y el modelo Tema.
require_once  './Config.php';
require_once Config::BASE_PATH. '/model/Tema.php';

// Definición de la clase TemasController.
class TemasController {
    // Propiedad para mantener una instancia del modelo Tema.
    private $tema;

    // Constructor que inicializa la propiedad tema.
    public function __construct() {
        $this->tema = new Tema();
    }

    // Método para listar todos los temas disponibles llamando al método read del modelo Tema.
    // Carga la vista listar.php para mostrar los resultados.
    public function listar() {
        $result = $this->tema->read();
        require_once Config::BASE_PATH.'/view/listar.php';
    }

    // Método para sortear (seleccionar aleatoriamente) temas.
    // Obtiene todos los temas disponibles y luego los carga en la vista sortear.php.
    public function sortear() {
        $tema = new Tema();
        $stmt = $tema->read();
        $temas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $temas[] = $row;
        }
        require_once Config::BASE_PATH.'/view/sortear.php'; 
    }
    
    // Método para agregar un nuevo tema.
    // Si el método es POST, obtiene los datos del formulario y llama al método create del modelo Tema.
    // Si la creación es exitosa, redirecciona al usuario a la lista de temas.
    public function agregar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->tema->nombre = $_POST['nombre'];
            $this->tema->descripcion = $_POST['descripcion'];
            $this->tema->tipo = $_POST['tipo'];
            $this->tema->activo = $_POST['activo'];

            if($this->tema->create()) {
                header("Location: index.php?action=listar");
            }
        }
        require_once Config::BASE_PATH.'/view/agregar.php';
    }
    
    // Método para editar un tema existente.
    // Si el método es POST y el ID está presente, actualiza el tema con los datos del formulario.
    // Si la actualización es exitosa, redirecciona al usuario a la lista de temas.
    // Si el método no es POST, carga la vista editar.php con los datos actuales del tema a editar.
    public function editar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $this->tema->id = $_POST['id'];
            $this->tema->nombre = $_POST['nombre'];
            $this->tema->descripcion = $_POST['descripcion'];
            $this->tema->tipo = $_POST['tipo'];
            $this->tema->activo = isset($_POST['activo']) ? 1 : 0;
    
            if($this->tema->update()) {
                header("Location: index.php?action=listar");
            }
        } else {
            $this->tema->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Falta ID.');
            $tema = $this->tema->readOne();
            require_once Config::BASE_PATH.'/view/editar.php';
        }
    }
    
    // Método para eliminar un tema.
    // Si el ID está presente, llama al método delete del modelo Tema.
    // Si la eliminación es exitosa, redirecciona al usuario a la lista de temas.
    public function eliminar() {
        if(isset($_POST['id'])) {
            $this->tema->id = $_POST['id'];
    
            if($this->tema->delete()) {
                header("Location: index.php?action=listar");
            }
        }
    }
}
?>
