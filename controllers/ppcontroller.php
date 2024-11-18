<?php
// Incluimos los archivos necesarios para acceder a la capa de datos (ppDAO) y a la vista (view)
include_once ('models/ppDAO.php');
include_once ('views/view.php');

// Definimos la clase controlador para gestionar las operaciones relacionadas con "Productospedidos"
class ppcontroller {

    // Método para obtener todos los productos pedidos
    public function getAllpp() {
        // Creamos una instancia del DAO para acceder a los datos
        $ppDAO = new ProductospedidosDAO();
        // Obtenemos todos los productos pedidos
        $arraypp = $ppDAO->getAllpp();
        // Llamamos a la vista para mostrar los productos pedidos, pasando los datos obtenidos
        view::show('listarpp', $arraypp);
    }

    // Método para obtener un pedido específico por su ID
    public function getPedidoById() {
        // Verificamos si el ID del pedido está presente en la solicitud GET
        if (isset($_GET['ID_Pedidos'])) {
            // Creamos una instancia del DAO para acceder a los datos
            $peDAO = new ProductospedidosDAO();
            // Obtenemos el pedido por su ID
            $pedido = $peDAO->getPedidoById($_GET['ID_Pedidos']);
            // Llamamos a la vista para mostrar el pedido específico, pasando los datos obtenidos
            View::show("pedidoporid", $pedido);
        }
    }
}
?>