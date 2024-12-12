<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Comprobar si la variable de sesión 'rol' está definida
    if (isset($_SESSION['rol'])) {
        // Si el rol del usuario es 'admin'
        if ($_SESSION['rol'] === 'administrador') {
            echo '<p>Bienvenido administrador,  ' . $_SESSION['nombre'] . '.</p>';
            echo '<br>';
            $ppDAO = new PedidosDAO();
            $pedidos = $ppDAO->historialPedidos(); // Obtenemos los pedidos
            $ppDAO = null; // Cerramos la conexión al DAO
            View::show("historialPedidos", $pedidos);
            
        }
        // Si el rol del usuario es 'normal'
        else if ($_SESSION['rol'] === 'normal') {
            echo '<p>Bienvenido, ' . $_SESSION['nombre'] . '.</p>';

            // Mostrar estructura con dos cuadros laterales y productos en el centro
    ?>
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <!-- Cuadro vertical de la izquierda -->
            <div class="col-md-2">
                <div class="card border-0">
                    <img src="img/Anuncio1.jpg" alt="Imagen izquierda" class="img-fluid" style="height: 100vh; object-fit: cover;">
                </div>
            </div>

            <!-- Centro: Productos -->
            <div class="col-md-8">
                <div class="row">
                    <?php
                    $pDAO = new ProductoDAO();
                    $products = $pDAO->getAllProducts();
                    $pDAO = null;
                    View::show("showProducts", $products);
                    ?>
                </div>
            </div>

            <!-- Cuadro vertical de la derecha -->
            <div class="col-md-2">
                <div class="card border-0">
                    <img src="img/Anuncio2.jpg" alt="Imagen derecha" class="img-fluid" style="height: 100vh; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <?php
        } // Cierre de else if
    } else {
        // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
        echo '<p>Por favor, inicie sesión.</p>';
        echo '<a href="IniciarSesion.php">Iniciar sesión</a>';
    }
    ?>
</body>
</html>