<?php

include_once("views/View.php");
include_once("models/pedidos.php");

class PedidosController
{
    /**
     * Método para agregar un producto al carrito de compras.
     */
    public function addCarrito()
    {
        // Inicia la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Inicializa el carrito si no está presente en la sesión
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        // Inicializa el contador de productos
        if (!isset($_SESSION['carrito_count'])) {
            $_SESSION['carrito_count'] = 0;
        }

        // Verifica si se ha pasado un id de producto
        if (isset($_GET['id_producto'])) {
            $productoid = $_GET['id_producto'];

            try {
                $pDAO = new ProductoDAO();
                $producto = $pDAO->getProductById($productoid);
                $pDAO = null;

                if ($producto) {
                    $found = false;
                    foreach ($_SESSION['carrito'] as &$item) {
                        if ($item['id'] == $productoid) {
                            $item['cantidad'] += 1;  // Incrementa la cantidad si ya está en el carrito
                            $found = true;
                            $_SESSION['carrito_count']++; // Incrementa el contador
                            break;
                        }
                    }
                    if (!$found) {
                        // Si el producto no está en el carrito, se agrega con cantidad 1
                        $_SESSION['carrito'][] = [
                            'id' => $producto['id_producto'],
                            'nombre' => $producto['nombre'],
                            'precio' => $producto['precio'],
                            'cantidad' => 1
                        ];
                        $_SESSION['carrito_count']++; // Incrementa el contador
                    }
                }
            } catch (Exception $e) {
                // Maneja posibles errores
                echo "Error: " . $e->getMessage();
                return;
            }
        }

        // Mostrar la vista carrito.php
        View::show("carrito", null);
    }

    public function realizarPedido() {
        $id_usuario = $_SESSION['id'] ?? null;

        echo $id_usuario;
    
        // Verificar si hay productos en el carrito
        if (empty($_SESSION['carrito'])) {
            echo '<p>No hay productos en tu cesta.</p>';
            return;
        }

        // Crear un nuevo pedido en la base de datos
        try {
            $pedidosDAO = new PedidosDAO();
            $id_pedido = $pedidosDAO->crearPedido();

            // Insertar productos en la tabla intermedia
            $pedidosDAO->insertarpp($id_pedido);

            // Vaciar el carrito después de realizar el pedido
            $_SESSION['carrito'] = [];
            $_SESSION['carrito_count'] = 0;

            echo "<p>Pedido realizado con éxito.</p>";

            View::show("carrito", null);
        } catch (Exception $e) {
            echo "Error al realizar el pedido: " . $e->getMessage();
        }
    }

    public function historialPedidos(){
        $ppDAO = new PedidosDAO();
        $pedidos = $ppDAO->historialPedidos(); // Obtenemos los pedidos
        $ppDAO = null; // Cerramos la conexión al DAO
        View::show("historialPedidos", $pedidos); // Pasamos los datos a la vista
    }
}
?>