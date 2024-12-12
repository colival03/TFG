<?php
/**
 *  Controlador de Productos. Implementará todas las acciones que se puedan llevar a cabo desde las vistas
 * que afecten a productos de la tienda.
 */

include_once("views/View.php");
include_once("models/productos.php");

class ProductController
{
    /**
     * Método que obtiene todos los productos de la base de datos y los muestra a través de la vista `showProducts`.
     */
    public function getAllProducts()
    {
        $pDAO = new ProductoDAO();
        $products = $pDAO->getAllProducts();
        $pDAO = null;
        View::show("showProducts", $products);
    }

    /**
     * Método que obtiene un producto por su ID y lo muestra a través de la vista `detalleProducts`.
     */
    public function getProductById()
    {
        $pDAO = new ProductoDAO();
        $id = $_REQUEST['id'];
        $product = $pDAO->getProductById($id);
        $pDAO = null;
        View::show("detalleProducts", $product);
    }

    /**
     * Método para insertar un producto nuevo.
     * Valida los datos y luego llama al modelo para realizar la inserción.
     */
    public function insertProduct()
    {
        $errors = array();
    
        // Verificar si se envió el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            // Validar los campos del formulario
            if (empty($_POST['Nombre'])) {
                $errors[] = "El nombre del producto es requerido.";
            }
            if (empty($_POST['Precio']) || !is_numeric($_POST['Precio'])) {
                $errors[] = "El precio es requerido y debe ser un número.";
            }
            if (empty($_POST['Descripcion']) || strlen($_POST['Descripcion']) < 10) {
                $errors[] = "La descripción debe tener al menos 10 caracteres.";
            }
            if (empty($_POST['Stock']) || !is_numeric($_POST['Stock'])) {
                $errors[] = "El stock es requerido y debe ser un número.";
            }
            if (empty($_POST['Categoria'])) {
                $errors[] = "La categoría es requerida.";
            }
    
            // Si hay errores, los mostramos
            if (!empty($errors)) {
                echo '<div class="error">';
                foreach ($errors as $error) {
                    echo '<p>' . htmlspecialchars($error) . '</p>'; // Usamos htmlspecialchars para evitar inyecciones XSS
                }
                echo '</div>';
            } else {
                // Procesar los datos del formulario
                $nombre = htmlspecialchars($_POST['Nombre']); // Limpiamos los inputs para evitar inyecciones
                $precio = htmlspecialchars($_POST['Precio']);
                $descripcion = htmlspecialchars($_POST['Descripcion']);
                $stock = htmlspecialchars($_POST['Stock']);
                $categoria = htmlspecialchars($_POST['Categoria']); 
                $fecha_creacion = date('Y-m-d H:i:s'); // Fecha actual para la inserción
    
                try {
                    // Creamos una instancia de ProductoDAO
                    $pDAO = new ProductoDAO();
    
                    // Insertamos el producto en la base de datos
                    $pDAO->insertProduct($nombre, $descripcion, $precio, $categoria, $stock, $fecha_creacion);
    
                    // Redirigir a la página de todos los productos
                    $this->getAllProducts();
                } catch (Exception $e) {
                    echo "Error al insertar el producto: " . $e->getMessage();
                }
            }
        } else {
            View::show("insertProducts", null);
        }
    }

    /**
     * Método para agregar un producto al carrito de compras.
     */
    public function addCarrito() {
        // Inicia la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Inicializa el carrito si no está presente en la sesión
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }
    
        // Inicializa el contador de productos
        if (!isset($_SESSION['carrito_count'])) {
            $_SESSION['carrito_count'] = 0;
        }
    
        // Verifica si se ha pasado un id de producto
        if (isset($_GET['id_producto'])) {
            $productoid = $_GET['id_producto'];
    
            try {
                $pDAO = new ProductoDAO();
                $producto = $pDAO->getProductById($productoid);
                $pDAO = null;
    
                if ($producto) {
                    $found = false;
                    foreach ($_SESSION['carrito'] as &$item) {
                        if ($item['id'] == $productoid) {
                            $item['cantidad'] += 1;  // Incrementa la cantidad si ya está en el carrito
                            $found = true;
                            $_SESSION['carrito_count']++; // Incrementa el contador
                            break;
                        }
                    }
                    if (!$found) {
                        // Si el producto no está en el carrito, se agrega con cantidad 1
                        $_SESSION['carrito'][] = [
                            'id' => $producto['id_producto'],
                            'nombre' => $producto['nombre'],
                            'precio' => $producto['precio'],
                            'cantidad' => 1
                        ];
                        $_SESSION['carrito_count']++; // Incrementa el contador
                    }
                }
            } catch (Exception $e) {
                // Maneja posibles errores
                echo "Error: " . $e->getMessage();
                return;
            }
        }
    
        // Mostrar la vista carrito.php
        View::show("carrito", null);
    }

    /**
     * Método para eliminar un producto o vaciar el carrito.
     */
    public function borrarcarrito($item_id = null) {
        if(isset($_SESSION['carrito'])) {
            if($item_id !== null) {
                // Si se proporciona un $item_id, eliminamos solo ese elemento del carrito
                foreach ($_SESSION['carrito'] as $key => $item) {
                    if($item['id'] === $item_id) {
                        unset($_SESSION['carrito'][$key]);
                        break;
                    }
                }
            } else {
                // Si no se proporciona $item_id, eliminamos todos los elementos del carrito
                $_SESSION['carrito'] = array();
            }
        }
        View::show("carrito", null);
    }

     // Método para manejar la búsqueda de productos por nombre
     public function buscarProductos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['nombre_producto']) && !empty(trim($_POST['nombre_producto']))) {
                $nombre = trim($_POST['nombre_producto']);
                
                // Crear una instancia del DAO
                $pDAO = new ProductoDAO();
                $productos = $pDAO->buscarPorNombre($nombre);
                
                // Verificar si se encontraron productos
                if ($productos) {
                    // Guardar los productos en la sesión
                    $_SESSION['productos'] = $productos;
                    $_SESSION['nombre_producto'] = $nombre;
                } else {
                    // Manejar el caso cuando no se encuentran productos
                    $_SESSION['mensaje_error'] = "No se encontraron productos con el nombre: " . htmlspecialchars($nombre);
                }
            } else {
                // Manejar el caso cuando no se proporciona un nombre de producto
                $_SESSION['mensaje_error'] = "Por favor, ingresa un nombre de producto.";
            }
        }
    
        // Mostrar la vista
        View::show("buscador");
    }
}
?>