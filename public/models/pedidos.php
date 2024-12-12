<?php
// Incluimos el archivo necesario para la conexión a la base de datos
include_once('database/db.php');

class PedidosDAO {
    private $db_con;

    // Constructor para establecer la conexión a la base de datos
    public function __construct() {
        $this->db_con = Database::connect();
    }

    public function crearPedido() {
        // Asegúrate de que la sesión está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Comprueba si el usuario está autenticado
        if (!isset($_SESSION['id_usuario'])) {
            throw new Exception("No se ha iniciado sesión.");
        }
    
        // Obtén el ID del usuario desde la sesión
        $id_usuario = $_SESSION['id_usuario'];
    
        $hoy = date("Y-m-d");
    
        // Preparamos la sentencia SQL para insertar un nuevo pedido
        $stmt = $this->db_con->prepare("INSERT INTO Pedidos (id_usuario, fecha) VALUES (:id_usuario, :fecha)");
        
        // Asignamos los parámetros de la sentencia SQL
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':fecha', $hoy);
    
        try {
            // Ejecutamos la sentencia SQL
            $stmt->execute();
            // Devolvemos el ID del último pedido insertado
            return $this->db_con->lastInsertId();
        } catch (PDOException $e) {
            echo "Error al crear el pedido: " . $e->getMessage();
            throw $e;
        }
    }
    

    // Método para insertar productos en un pedido
    public function insertarpp($id_pedido) {
        // Preparamos la sentencia SQL para insertar productos en un pedido
        $stmt = $this->db_con->prepare("INSERT INTO pedido_producto(id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)");
        
        // Recorremos los productos en el carrito de la sesión
        foreach ($_SESSION['carrito'] as $pp) {
            // Asignamos los parámetros de la sentencia SQL
            $stmt->bindValue(':id_pedido', $id_pedido);
            $stmt->bindValue(':id_producto', $pp['id']);
            $stmt->bindValue(':cantidad', $pp['cantidad']);
            // Ejecutamos la sentencia SQL
            $stmt->execute();
        }
    }

    // Método para sacar el historial de pedidos 

    public function historialPedidos() {
        $stmt = $this->db_con->prepare("SELECT * FROM Pedidos");
        $stmt->execute(); // Ejecutamos la consulta
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtenemos todos los resultados
        return $result; // Devolvemos los resultados
    }
}
?>