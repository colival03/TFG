<?php
// Incluimos el archivo necesario para la conexión a la base de datos
include_once ('database/db.php');

class ProductospedidosDAO {
    private $db_con;

    // Constructor para establecer la conexión a la base de datos
    function __construct() {
        $this->db_con = Database::connect();
    }

    // Método para obtener todos los pedidos
    public function getAllpp() {
        // Preparamos la sentencia SQL para seleccionar todos los registros de la tabla Pedidos
        $stmt = $this->db_con->prepare("SELECT * FROM Pedidos");
        // Configuramos el modo de obtención de resultados a un array asociativo
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos la sentencia SQL
        $stmt->execute();
        // Devolvemos todos los resultados obtenidos
        return $stmt->fetchAll();
    }

    // Método para obtener los productos de un pedido específico por su ID
    public function getPedidoById($id) {
        // Preparamos la sentencia SQL para seleccionar todos los registros de la tabla ProductosPedidos que coincidan con el ID del pedido
        $stmt = $this->db_con->prepare("SELECT * FROM ProductosPedidos WHERE ID_Pedidos = :id");
        // Asignamos el parámetro ID del pedido a la sentencia SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Configuramos el modo de obtención de resultados a un array asociativo
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // Ejecutamos la sentencia SQL
        $stmt->execute();
        // Devolvemos todos los resultados obtenidos
        return $stmt->fetchAll();
    }
}
?>