<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
        /* Estilo del header */
        .header {
            background: linear-gradient(to right, #333333, #0d47a1); /* Fondo degradado */
            color: #ffffff; /* Texto blanco */
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
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

        .header .btn-group {
            display: flex;
            gap: 10px; /* Espacio entre los botones */
        }

        /* Estilo de la página de inicio de sesión */
        body, html {
            height: 100%; /* Asegura que body y html cubran el 100% de la ventana */
            margin: 0;
        }

        body {
            background: linear-gradient(to bottom, #333333, #81d4fa); /* Fondo de degradado */
            color: #333333; /* Texto oscuro */
            font-family: 'Arial', sans-serif;
            padding-top: 80px; /* Compensa la altura del header */
        }

        /* Centrar el cuadro de login */
        .container-login {
            background-color: #ffffff; /* Fondo blanco */
            border: 1px solid #b3e5fc; /* Borde con color de azul claro */
            border-radius: 6px; /* Bordes moderadamente redondeados */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra más ligera */
            padding: 20px 40px; /* Menos padding arriba/abajo, más a los lados */
            max-width: 360px; /* Ancho ligeramente mayor */
            margin: auto; /* Centrar horizontal y verticalmente */
            min-height: calc(100vh - 140px); /* Ajustar altura */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centrar el contenido dentro del contenedor */
        }

        /* Estilo para hacer el cuadro más atractivo */
        .container-login h2 {
            text-align: center;
            color: #0277bd; /* Color azul */
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 22px;
        }

        .container-login .form-group label {
            font-size: 15px;
            font-weight: bold;
            color: #333;
        }

        .container-login input[type="text"],
        .container-login input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px; /* Menos redondeado */
            font-size: 14px;
            transition: box-shadow 0.3s ease;
        }

        /* Efecto de foco en los campos del formulario */
        .container-login input[type="text"]:focus,
        .container-login input[type="password"]:focus {
            box-shadow: 0 0 5px rgba(2, 119, 189, 0.5); /* Sombra más pequeña al hacer foco */
            border-color: #0277bd; /* Borde azul al hacer foco */
        }

        /* Estilo del botón de envío */
        .container-login input[type="submit"] {
            background-color: #0277bd;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container-login input[type="submit"]:hover {
            background-color: #01579b;
        }

        /* Mensaje de alerta */
        .container-login .alert {
            margin-top: 10px;
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            color: #d32f2f;
            background-color: #ffcdd2;
            border: 1px solid #e57373;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .container-login {
                padding: 20px;
            }

            .container-login h2 {
                font-size: 20px;
            }

            .container-login input[type="text"],
            .container-login input[type="password"],
            .container-login input[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <!-- Header de la tienda -->
    <header class="header">
        <div class="container">
            <!-- Nombre de la tienda -->
            <div class="brand">Mi Tienda</div>

            <!-- Botones de navegación -->
            <div class="btn-group">
                <a href="index.php?controller=UserController&action=showiniciosesion" class="btn btn-light">
                    Iniciar Sesión
                </a>

                <a href="index.php?controller=CartController&action=viewCart" class="btn btn-light">
                    <span class="badge bg-danger" id="cart-count">0</span> Carrito
                </a>
            </div>
        </div>
    </header>

    <!-- Formulario de inicio de sesión -->
    <div class="container-login">
        <h2>Iniciar Sesión</h2>
        <form action="index.php?controller=UserController&action=validacioniniciosesion" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre de Usuario:</label>
                <input type="text" id="nombre" name="nombre">
                <?php
                if (isset($data) && isset($data['nombre'])) {
                    echo "<div class='alert alert-danger'>" . $data['nombre'] . "</div>";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena">
                <?php
                if (isset($data) && isset($data['contrasena'])) {
                    echo "<div class='alert alert-danger'>" . $data['contrasena'] . "</div>";
                }
                ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Iniciar Sesión" name="iniciarsesion">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9g63TAv06P2K+S/bztnQ+6ntRch4B6F+M2m5UqkM56wB1FZ35B9" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>