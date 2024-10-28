<?php
// Inicializa el carrito si no está ya inicializado
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Función para calcular el total del carrito
function calcularTotal($carrito)
{
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
    return $total;
}

// Verificar si se ha solicitado la eliminación de un artículo
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($_SESSION['carrito'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['carrito'][$key]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el array
            break;
        }
    }
}

// Obtener el carrito de la sesión
$carrito = $_SESSION['carrito'];
$total = calcularTotal($carrito);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #000000, #000066); /* Degradado lateral */
            color: #ffffff;
            padding-top: 20px;
        }

        .header {
            background: #1e88e5;
            padding: 15px;
            color: white;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .container {
            background-color: #ffffff;
            color: #333333;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dddddd;
        }

        th {
            background-color: #1e88e5;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #0277bd;
            color: white;
        }

        .btn-primary:hover {
            background-color: #01579b;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        h3 {
            text-align: right;
            color: #333333;
        }
    </style>
</head>
<body>

<!-- Encabezado -->
<div class="header">
    <h1>Carrito de Compras</h1>
</div>

<div class="container">
    <?php if (!empty($carrito)): ?>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td><?php echo number_format($item['precio'], 2); ?> €</td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?> €</td>
                        <td>
                            <a href="index.php?controller=ProductController&action=borrarcarrito&id=<?php echo $item['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Total: <?php echo number_format($total, 2); ?> €</h3>
        <a href="index.php?controller=ProductController&action=getAllProducts" class="btn btn-primary">Seguir Comprando</a>
        <a href="index.php?controller=PedidosController&action=pago" class="btn btn-success">Proceder al Pago</a>
    <?php else: ?>
        <p>Tu carrito está vacío.</p>
        <a href="index.php?controller=ProductController&action=getAllProducts" class="btn btn-primary">Ir a Comprar</a>
    <?php endif; ?>
</div>

</body>
</html>