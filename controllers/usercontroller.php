<?php  
include_once ("models/usuarios.php");
include_once ("views/View.php");

class UserController{
    public function insertUser()
{
    $datosusu = array();
    $errors = array();

    // Verificar si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar los campos del formulario
        if (empty($_POST['nombre'])) {
            $errors[] = "El nombre del usuario es requerido.";
        }
        if (empty($_POST['email'])) {
            $errors[] = "El correo es requerido.";
        }
        if (empty($_POST['contrasena']) || strlen($_POST['contrasena']) < 4) {
            $errors[] = "La contraseña debe tener al menos 4 caracteres.";
        }
        if (empty($_POST['rol'])) {
            $errors[] = "El rol es requerido.";
        }
        if (empty($_POST['direccion'])) {
            $errors[] = "La dirección es requerida.";
        }
        if (empty($_POST['telefono'])) {
            $errors[] = "El teléfono es requerido.";
        }
        if (empty($_POST['fecha_registro'])) {
            $errors[] = "La fecha de registro es requerida.";
        }

        // Si hay errores, mostrarlos en la página
        if (!empty($errors)) {
            echo '<div class="error">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
            // Mostrar la vista con los datos del usuario
            View::show("insertUsers", $datosusu);
        } else {
            // Si no hay errores, procesamos los datos del formulario
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $rol = $_POST['rol'];

            // Creamos una instancia de la clase UserDao
            $uDAO = new UserDao();

            // Insertamos los datos en la base de datos
            $result = $uDAO->insertUser($nombre, $email, $contrasena, $rol);

            // Verificar si la inserción fue exitosa
            if ($result) {
                echo '<div class="success">';
                echo '<p>Usuario insertado exitosamente.</p>';
                echo '</div>';
                // Redireccionar a una página de éxito o realizar otras acciones necesarias
            } else {
                // En caso de error en la inserción, mostrar un mensaje de error
                echo '<div class="error">';
                echo '<p>Error al insertar el usuario. Por favor, inténtalo de nuevo.</p>';
                echo '</div>';
                // Puedes decidir mostrar la vista de nuevo o redirigir a otra página
            }
        }
    } else {
        // Si no se ha enviado el formulario, mostrar la vista "insertUsers"
        View::show("insertUsers", $datosusu);
    }
}

    public function showiniciosesion(){
        View::show("iniciarsesion");
    }
    
    public function validacioniniciosesion() {
        $errores = array();
        if (isset($_POST['iniciarsesion'])) {
            if (!isset($_POST['nombre']) || strlen($_POST['nombre']) == 0) {
                $errores['nombre'] = "El nombre debe estar relleno";
            }
            if (!isset($_POST['contrasena']) || strlen($_POST['contrasena']) == 0) {
                $errores['contrasena'] = "La contrasena no puede estar vacia";
            }
            if (empty($errores)) {
                $uDAO = new UserDAO();
                $user = $uDAO->getAllUsers($_POST['nombre'], $_POST['contrasena']);
                if (empty($user)) {
                    $errores['general'] = "El usuario no está registrado.";
                    View::show("iniciarsesion", $errores);
                } else {
                    $_SESSION['nombre'] = $_POST['nombre'];
                    $_SESSION['rol'] = $user['rol']; // Asumiendo que el rol está en el campo 'rol' del usuario
    
                    if ($user['rol'] == 'administrador') {
                        View::show("paginasusuarios", array('rol' => 'administrador'));
                    } else {
                        View::show("paginasusuarios", array('rol'=> 'normal'));
                    }
                }
            } else {
                View::show("iniciarSesion", $errores);
            }
        }
    }
    
    public function cerrarsesion(){
        session_destroy();
        View::show("iniciarSesion");
    }
}
?>