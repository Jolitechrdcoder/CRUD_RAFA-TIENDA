<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require 'funciones.php';
    require 'vendor/autoload.php';

    // Crear instancia de Cliente
    $cliente = new mecatronicosrd\Cliente;

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {

        // Registrar cliente
        $_params_cliente = array(
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'email' => $_POST['email'],
            'telefono' => $_POST['telefono'],
            'comentario' => $_POST['comentario']
        );

        $cliente_id = $cliente->registrar($_params_cliente);

        // Crear instancia de Pedido
        $pedido = new mecatronicosrd\Pedido;

        // Registrar pedido
        $_params_pedido = array(
            'cliente_id' => $cliente_id,
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d')
        );

        $pedido_id = $pedido->registrar($_params_pedido);

        // Registrar detalles del pedido
        foreach ($_SESSION['carrito'] as $indice => $value) {
            $_params_detalle = array(
                "pedido_id" => $pedido_id,
                "producto_id" => $value['id'],
                "precio" => $value['precio'],
                "cantidad" => $value['cantidad'],
            );

            $pedido->registrarDetalle($_params_detalle);
        }

        // Limpiar carrito
        $_SESSION['carrito'] = array();

        header('Location: gracias.php');
    }
}
