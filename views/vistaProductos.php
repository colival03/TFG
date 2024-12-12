<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de búsqueda - Categoría: <?php echo htmlspecialchars($categoria); ?></title>
    <style>
        /* Estilos básicos para los productos */
        .producto {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            width: 200px;
            display: inline-block;
        }
        .producto h3 {
            margin: 0;
        }
    </style>
</head>
<body>

    <h1>Resultados de búsqueda para la categoría: <?php echo htmlspecialchars($categoria); ?></h1>

    <?php if (isset($mensaje)): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php else: ?>
        <div class="productos">
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                    <p>Precio: <?php echo htmlspecialchars($producto['precio']); ?>€</p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</body>
</html>