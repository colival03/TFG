<?php
include_once ("database/db.php");

class UserDao {
    private $db_con;

    public function __construct() {
        $this->db_con = Database::connect();
    }

    public function insertUser( $Nombre, $email, $contrasena, $rol){
        $stmt= $this->db_con->prepare ("Insert into Usuarios (Nombre, email, contrasena, rol) values (:Nombre, :email, :contrasena, :rol)");      
        
        $stmt->bindParam(':Nombre', $Nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':rol', $rol);

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