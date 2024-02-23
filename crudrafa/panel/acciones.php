<?php

require '../vendor/autoload.php';

use mecatronicosrd\Productos;

$productos = new Productos;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['accion'] === 'Registrar') {

        // Validaciones y obtención de datos
        $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
        $categoria_id = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 0;
        $precio = isset($_POST['precio']) ? floatval(str_replace(',', '.', $_POST['precio'])) : 0;

        // Validaciones
        if (empty($titulo) || empty($descripcion) || empty($categoria_id) || !is_numeric($categoria_id) || !is_numeric($precio) || $precio <= 0) {
            exit('Por favor, completa todos los campos correctamente.');
        }

        // Parámetros para el registro
        $params = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'foto' => subirFoto(),
            'precio' => $precio,
            'categoria_id' => $categoria_id,
            'fecha' => date('Y-m-d')
        );

        // Intentar registrar el producto
        $rpt = $productos->registrar($params);

        if ($rpt) {
            header('Location: productos/index.php');
        } else {
            print 'Error al registrar productos';
        }
    }

    if ($_POST['accion'] === 'Actualizar') {
       // Validaciones y obtención de datos
$titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
$descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
$categoria_id = isset($_POST['categoria_id']) ? intval($_POST['categoria_id']) : 0;
$precio = isset($_POST['Precio']) ? floatval(str_replace(',', '.', $_POST['Precio'])) : 0;

// Validaciones
if (empty($titulo) || empty($descripcion) || empty($categoria_id) || !is_numeric($categoria_id) || !is_numeric($precio) || $precio <= 0) {
    exit('Por favor, completa todos los campos correctamente. Datos recibidos: ' . json_encode($_POST));
}

        // Parámetros para la actualización
        $params = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'categoria_id' => $categoria_id,
            'fecha' => date('Y-m-d'),
            'id' => $_POST['id'],
            'foto' => ''
        );

        // Verifica si hay una foto temporal y úsala
        if (!empty($_POST['foto_temp'])) {
            $params['foto'] = $_POST['foto_temp'];
        } elseif (!empty($_FILES['foto']['name'])) {
            // Si no hay foto temporal, intenta subir la nueva foto
            $params['foto'] = subirFoto();
        }

        // Intentar actualizar el producto
        $rpt = $productos->actualizar($params);

        if ($rpt) {
            header('Location: productos/index.php');
        } else {
            print 'Error al Actualizar productos';
        }
    }
}

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    
    $id = $_GET['id'];
    $rpt = $productos->eliminar($id);
    
   

    if ($rpt) {
        header('Location: productos/index.php');
    } else {
        print 'Error al Eliminar producto';
    }

}


function subirFoto()
{
    $carpeta = __DIR__ . '/../upload/';
    $archivo = $carpeta . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);
    return $_FILES['foto']['name'];
}

?>
