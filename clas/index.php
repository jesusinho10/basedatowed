<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Define el conjunto de caracteres para la página -->
    <meta charset="UTF-8">
    <!-- Título de la página web -->
    <title>Mi aplicación MVC</title>
    <!-- Estilos internos para dar formato a la página y sus elementos -->
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .boton-agregar { padding: 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .boton-agregar:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<!-- Links que actúan como botones para realizar diferentes acciones, como agregar un nuevo tema o sortear entre los temas existentes -->
<a href="index.php?action=agregar" class="boton-agregar">Nuevo Tema</a><br><br><br>
<a href="index.php?action=sortear" class="boton-agregar">Sortear</a>
<br><br>
<br>
<?php
// Requiere el controlador TemasController.php para gestionar las solicitudes.
require_once 'controller/TemasController.php';

// Instancia un nuevo objeto del controlador.
$controller = new TemasController();

// Verifica si existe algún parámetro 'action' en la URL.
if (isset($_GET['action'])) {
    // Según el valor de 'action', llama a diferentes métodos del controlador.
    switch ($_GET['action']) {
        case 'listar':
            $controller->listar();
            break;
        case 'agregar':
            $controller->agregar();
            break;
        case 'editar':
            $controller->editar();
            break;
        case 'eliminar':
            $controller->eliminar();
            break;
        case 'sortear':
            $controller->sortear();
            break;
        default:
            // Si el valor de 'action' no coincide con ninguno esperado, muestra un mensaje de error.
            echo "Página no encontrada";
            break;
    }
} else {
    // Si no hay acción especificada, por defecto lista los temas.
    $controller->listar();
}
?>

</body>
</html>
