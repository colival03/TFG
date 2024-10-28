<?php
include_once("database/db.php");

class PedidosDAO {
    // Atributo con la conexión a la base de datos.
    public $db_con;

    // Constructor que inicializa la conexión a la base de datos.
    public function __construct() {
        $this->db_con = Database::connect();
    }

    public function insertPago($nombre, $apellidos, $metodoPago, $numeroCuenta, $fechaRegistro) {
        $stmt = $this->db_con->prepare("
            INSERT INTO pedidos (nombre, apellidos, metodoPago, numeroCuenta, fechaRegistro)
            VALUES (:nombre, :apellidos, :metodoPago, :numeroCuenta, :fechaRegistro)");
    
        // Vinculamos los parámetros con los placeholders correctos
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':metodoPago', $metodoPago);
        $stmt->bindParam(':numeroCuenta', $numeroCuenta);
        $stmt->bindParam(':fechaRegistro', $fechaRegistro);
    
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function obtenerHistorialPedidos() {
        $stmt = $this->db_con->prepare("SELECT * FROM pedidos");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>