<?php
include_once ("database/db.php");

/**
 * Clase de acceso a datos para la tabla productos. Implementa todos los métodos que necesiten
 * interactuar con la tabla productos de la base de datos.
 */
class ProductoDAO {

    // Atributo con la conexión a la base de datos.
    public $db_con;

    // Constructor que inicializa la conexión a la base de datos.
    public function __construct (){
        $this->db_con = Database::connect();
    }

    /**
     * Método que devuelve un array con todos los productos existentes en la base de datos.
     */
    public function getAllProducts(){
        $stmt = $this->db_con->prepare("SELECT * FROM productos");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Método que devuelve un producto por su ID.
     */
    public function getProductById($id) {
        $stmt = $this->db_con->prepare("SELECT * FROM productos WHERE id_producto = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Método para insertar un producto en la base de datos.
     */
    public function insertProduct($Nombre, $Descripcion, $Precio, $id_categoria, $Stock, $fecha_creacion) {
        $stmt = $this->db_con->prepare("
            INSERT INTO productos (nombre, descripcion, precio, id_categoria, stock, fecha_creacion)
            VALUES (:nombre, :descripcion, :precio, :id_categoria, :stock, :fecha_creacion)");
    
        // Vinculamos los parámetros con los placeholders correctos
        $stmt->bindParam(':nombre', $Nombre);
        $stmt->bindParam(':descripcion', $Descripcion);
        $stmt->bindParam(':precio', $Precio);
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':stock', $Stock);
        $stmt->bindParam(':fecha_creacion', $fecha_creacion);
    
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Método para eliminar un producto de la base de datos.
     */
    public function deleteProduct($id) {
        $stmt = $this->db_con->prepare("DELETE FROM productos WHERE id_producto = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function buscarPorCategoria($categoria) {
        $stmt = $this->db_con->prepare("SELECT * FROM productos WHERE categoria = :categoria");
        $stmt->bindParam(':categoria', $categoria);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorNombre($nombre) {
        // Consulta para buscar productos por nombre
        $query = "SELECT * FROM productos WHERE nombre LIKE :nombre";
        $stmt = $this->db_con->prepare($query);

        // Usamos LIKE para permitir coincidencias parciales
        $nombreBusqueda = "%" . $nombre . "%";
        $stmt->bindParam(':nombre', $nombreBusqueda);

        // Ejecutamos la consulta
        $stmt->execute();

        // Retornamos los resultados en forma de array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>