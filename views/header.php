<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encabezado de la Tienda</title>
    <!-- Bootstrap CSS para estilos adicionales -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .header {
            background: linear-gradient(to right, #333333, #0d47a1);
            color: #ffffff;
            padding: 10px 0;
        }

        .header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .header .search-form {
            flex: 1;
            margin: 0 20px;
        }

        .header .btn-group {
            display: flex;
            gap: 10px;
        }

        .header .btn {
            margin-right: 5px;
        }

        .dropdown-menu {
            min-width: 200px;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="brand">Mi Tienda</div>

            <!-- Buscador con método POST -->
            <form class="search-form" action="index.php?controller=ProductController&action=buscarProductos" method="POST">
                <div class="input-group">
                    <input type="text" name="nombre_producto" class="form-control" placeholder="Buscar productos..." required>
                    <button type="submit" class="btn btn-light">Buscar</button>
                </div>
            </form>

            <!-- Botones de navegación -->
            <div class="btn-group">
                <!-- Botón desplegable de categorías -->
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?category=Informatica">Informática</a></li>
                        <li><a class="dropdown-item" href="index.php?category=HogarCocina">Hogar y Cocina</a></li>
                        <li><a class="dropdown-item" href="index.php?category=Electronica">Electrónica</a></li>
                    </ul>
                </div>
                <!-- Otros botones -->
                <a href="index.php?controller=UserController&action=showiniciosesion" class="btn btn-light">Iniciar Sesión</a>
                <a href="index.php?controller=ProductController&action=addcarrito" class="btn btn-light">
                    <span class="badge bg-danger" id="cart-count">0</span> Carrito
                </a>
                <a href="index.php?controller=ProductController&action=getAllProducts" class="btn btn-light">Productos</a>

                <?php if (!empty($_SESSION['nombre']) && $_SESSION['rol'] == 'normal'): ?>
                    <a href="index.php?controller=ProductController&action=getAllProducts" class="btn btn-light">Listar Productos</a>
                    <a href="index.php?controller=UserController&action=cerrarsesion" class="btn btn-light">Cerrar sesión</a>
                <?php elseif (!empty($_SESSION['nombre']) && $_SESSION['rol'] == 'administrador'): ?>
                    <a href="index.php?controller=ProductController&action=insertProduct" class="btn btn-light">Insertar Productos</a>
                    <a href="index.php?controller=UserController&action=insertuser" class="btn btn-light">Insertar Usuarios</a>
                    <a href="index.php?controller=PedidosController&action=historialPedidos" class="btn btn-light">Historial Pedidos</a>
                    <a href="index.php?controller=UserController&action=cerrarsesion" class="btn btn-light">Cerrar sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Bootstrap JS y Popper.js para funcionalidad del menú desplegable -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9g63TAv06P2K+S/bztnQ+6ntRch4B6F+M2m5UqkM56wB1FZ35B9" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93+N8F4sOOhF+sm4xK5nO4A5uO2P0L6ibI60FhDQ7V0jr9Vp7Rkb4F1E9DT+p1" crossorigin="anonymous"></script>
</body>

</html>