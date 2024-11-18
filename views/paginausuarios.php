<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Bienvenida</title>
    <style>
        body {
            background: linear-gradient(to right, #1a2a6c, #b21f1f, #fdbb2d);
            color: white;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            width: 80%;
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .container:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.02);
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            letter-spacing: 1.5px;
            color: #fdbb2d;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
        }
        .button {
            background-color: #fdbb2d;
            border: none;
            color: #1a2a6c;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1.2em;
            border-radius: 25px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .button:hover {
            background-color: #1a2a6c;
            color: #fdbb2d;
        }
        img {
            width: 100%;
            max-width: 900px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
    if (!isset($_SESSION['nombre'])) {
        $_SESSION['nombre'] = array();
    }
    if (!isset($_SESSION['rol'])) {
        $_SESSION['rol'] = array();
    }
    if (!empty($_SESSION['nombre']) && $_SESSION['rol'] == 'normal') {
        $pDAO = new ProductoDAO();
        $products = $pDAO->getAllProducts();
        $pDAO = null;
        View::show("showProducts", $products);
    } elseif (!empty($_SESSION['nombre']) && $_SESSION['rol'] == 'administrador') {
        echo '<div class="container">';
        echo '<h1>Bienvenido Administrador</h1>';
        echo '<p>Gracias por gestionar nuestra tienda en línea. Aquí tienes acceso a las funciones administrativas.</p>';
        echo '<div>';
        echo '<img src="img/portada.jpg" alt="Portada Administrador">';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="container">';
        echo '<h1>Acceso Denegado</h1>';
        echo '<p>Usuario no registrado en la base de datos. Por favor, contacta al administrador.</p>';
        echo '</div>';
    }
    ?>
</body>
</html>