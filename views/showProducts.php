<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos - Tienda de Coches</title>
    <!-- Bootstrap CSS para estilos adicionales -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #333333, #0d47a1);
            color: #333333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(to right, #333333, #0d47a1);
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #ffffff;
        }

        .card {
            margin-bottom: 20px;
            background-color: #e1f5fe;
            border: 1px solid #b3e5fc;
        }

        .card-body {
            text-align: center;
        }

        .card-title {
            font-weight: bold;
        }

        .btn-info {
            background-color: #1e88e5;
            border-color: #1e88e5;
        }

        .btn-info:hover {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }

        .card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            foreach ($data as $producto) {
                // Construir la ruta de la imagen
                $imagen_nombre = 'producto' . $producto['id_producto'] . '.jpg'; // Cambia 'jpg' si las imágenes tienen otro formato
                $imagen_ruta = 'img/' . $imagen_nombre;

                echo "<div class='col-md-4'>
                    <div class='card'>
                        <div class='card-body'>";
                
                // Mostrar imagen o mensaje alternativo
                if (file_exists($imagen_ruta)) {
                    echo "<img src='" . htmlspecialchars($imagen_ruta) . "' alt='" . htmlspecialchars($producto['id_producto']) . "' class='img-fluid'>";
                } else {
                    echo "<img src='placeholder.jpg' alt='Imagen no disponible' class='img-fluid'>"; // Puedes usar una imagen de marcador de posición
                }

                // Mostrar información del producto
                echo "<h5 class='card-title'>" . htmlspecialchars($producto['nombre']) . "</h5>
                        <p class='card-text'>" . htmlspecialchars($producto['descripcion']) . "</p>
                        <p><strong>Precio:</strong> " . htmlspecialchars($producto['precio']) . " €</p>
                        <p><strong>Stock:</strong> " . htmlspecialchars($producto['stock']) . "</p>
                        <a href='index.php?controller=ProductController&action=getProductById&id=" . htmlspecialchars($producto['id_producto']) . "' class='btn btn-info'>Información</a>
                        <a href='index.php?controller=ProductController&action=addCarrito&id_producto=" . htmlspecialchars($producto['id_producto']) . "' class='btn btn-info'>Añadir al Carrito</a>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
</body>

</html>