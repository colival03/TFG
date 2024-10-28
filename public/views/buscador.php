<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin: 10px 0;
        }
        .img-fluid {
            max-height: 200px; /* Limitar la altura de las imágenes */
            object-fit: cover; /* Ajustar la imagen sin distorsionar */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Resultados de la Búsqueda para: <?= htmlspecialchars($_SESSION['nombre_producto']); ?></h1>
        <div class="row">
            <?php 
            if (isset($_SESSION['productos']) && !empty($_SESSION['productos'])):
                $productos = $_SESSION['productos'];
                foreach ($productos as $producto):
                    // Construir la ruta de la imagen
                    $imagen_nombre = 'producto' . htmlspecialchars($producto['id_producto']) . '.jpg'; // Cambia 'jpg' si las imágenes tienen otro formato
                    $imagen_ruta = 'img/' . $imagen_nombre;
            ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Mostrar imagen o mensaje alternativo -->
                                <?php if (file_exists($imagen_ruta)): ?>
                                    <img src="<?= htmlspecialchars($imagen_ruta); ?>" alt="<?= htmlspecialchars($producto['nombre']); ?>" class="img-fluid">
                                <?php else: ?>
                                    <img src="placeholder.jpg" alt="Imagen no disponible" class="img-fluid">
                                <?php endif; ?>
                                
                                <h5 class="card-title">ID: <?= htmlspecialchars($producto['id_producto']); ?></h5>
                                <p class="card-text">Nombre: <?= htmlspecialchars($producto['nombre']); ?></p>
                                <p class="card-text">Precio: $<?= number_format(htmlspecialchars($producto['precio']), 2); ?></p>
                                <a href="index.php?controller=ProductController&action=getProductById&id=<?= htmlspecialchars($producto['id_producto']); ?>" class="btn btn-info">Información</a>
                                <a href="index.php?controller=ProductController&action=addCarrito&id_producto=<?= htmlspecialchars($producto['id_producto']); ?>" class="btn btn-info">Añadir al Carrito</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No se encontraron productos con el nombre especificado.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>