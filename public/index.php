<?php
session_start();

include_once("views/header.php");
include_once("controllers/productscontroller.php");
include_once("controllers/usercontroller.php");
include_once("controllers/pedidoscontroller.php");

// Punto de entrada a la aplicación
if (isset($_REQUEST['action']) && isset($_REQUEST['controller'])) {
    $act = $_REQUEST['action'];
    $cont = $_REQUEST['controller'];

    // Instanciación del controlador e invocación del método
    $controller = new $cont();
    $controller->$act();
} else {
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
                    $products = $pDAO-> getAllProducts();
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
}

include_once("views/footer.php");
?>