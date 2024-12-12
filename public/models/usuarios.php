<?php
include_once ("database/db.php");

class UserDao {
    private $db_con;

    public function __construct() {
        $this->db_con = Database::connect();
    }

    public function insertUser( $Nombre, $email, $contrasena, $rol, $telefono, $direccion, $fecha_registro) {
        $stmt= $this->db_con->prepare ("Insert into Usuarios (Nombre, email, contrasena, rol, direccion, telefono, fecha_registro) values (:Nombre, :email, :contrasena, :rol, :direccion, :telefono, :fecha_registro)");      
        
        $stmt->bindParam(':Nombre', $Nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':fecha_registro', $fecha_registro);

        try{
            return $stmt->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getAllUsers($nombre, $contrasena) {
        $stmt = $this->db_con->prepare("SELECT * FROM Usuarios WHERE Nombre = ? AND contrasena = ?");
        $stmt->execute([$nombre, $contrasena]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>