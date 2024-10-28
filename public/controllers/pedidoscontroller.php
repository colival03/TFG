<?php 

include_once("views/View.php");
include_once("models/pedidos.php");

class PedidosController
{

    public function pago()
{
    $errors = array();

    // Verificar si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validar los campos del formulario
        if (empty($_POST['nombre'])) {
            $errors[] = "El nombre es requerido.";
        }
        if (empty($_POST['apellidos'])) {
            $errors[] = "Los apellidos son requeridos.";
        }
        if (empty($_POST['metodoPago'])) {
            $errors[] = "El método de pago es requerido.";
        }
        if (empty($_POST['numeroCuenta']) || !is_numeric($_POST['numeroCuenta'])) {
            $errors[] = "El número de cuenta es requerido y debe ser un número válido.";
        }

        // Si hay errores, los mostramos
        if (!empty($errors)) {
            echo '<div class="error">';
            foreach ($errors as $error) {
                echo '<p>' . htmlspecialchars($error) . '</p>'; // Usamos htmlspecialchars para evitar inyecciones XSS
            }
            echo '</div>';
        } else {
            // Procesar los datos del formulario
            $nombre = htmlspecialchars($_POST['nombre']); // Limpiamos los inputs para evitar inyecciones
            $apellidos = htmlspecialchars($_POST['apellidos']);
            $metodoPago = htmlspecialchars($_POST['metodoPago']);
            $numeroCuenta = htmlspecialchars($_POST['numeroCuenta']);
            $fechaRegistro = date('Y-m-d H:i:s'); // Fecha actual para la inserción

            try {
                // Creamos una instancia de PedidosDAO
                $pDAO = new PedidosDAO();

                // Insertamos el pago en la base de datos
                $pDAO->insertPago($nombre, $apellidos, $metodoPago, $numeroCuenta, $fechaRegistro);

            } catch (Exception $e) {
                echo "Error al procesar el pago: " . $e->getMessage();
            }
        }
    } else {
        View::show("pagopedido", null); // Mostrar el formulario de pago
    }
}


public function historialPedidos()
{
    $pDAO = new PedidosDAO();
        $pedidos = $pDAO->obtenerHistorialPedidos();
        $pDAO = null;
        View::show("historialPedidos", $pedidos);
}
}
?>
