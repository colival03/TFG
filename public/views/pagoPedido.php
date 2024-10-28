<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago - Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #333333, #0d47a1);
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(to right, #333333, #0d47a1);
            color: #000;
            padding: 15px 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #e1f5fe;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
        }

        .btn-primary {
            background-color: #1e88e5;
            border-color: #1e88e5;
        }

        .btn-primary:hover {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }

        label {
            color: #333333;
            font-weight: bold;
        }

        input, select {
            margin-bottom: 15px;
        }

        .form-group input, .form-group select {
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 8px rgba(30, 136, 229, 0.5);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Formulario de Pago</h1>

    <?php
    // Mostrar errores si existen
    if (isset($errors) && !empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo '<p>' . htmlspecialchars($error) . '</p>';
        }
        echo '</div>';
    }
    ?>

    <form action="index.php?controller=PedidosController&action=pago" method="post">
        <!-- Campos del formulario -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>

        <div class="form-group">
            <label for="metodoPago">Método de Pago</label>
            <select class="form-control" id="metodoPago" name="metodoPago" required>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Bizum">Bizum</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Reembolso">Reembolso</option>
            </select>
        </div>

        <div class="form-group">
            <label for="numeroCuenta">Número de Cuenta</label>
            <input type="text" class="form-control" id="numeroCuenta" name="numeroCuenta" required>
        </div>

        <div class="form-group">
            <label for="fechaRegistro">Fecha de Registro</label>
            <input type="date" class="form-control" id="fechaRegistro" name="fechaRegistro" disabled
                   value="<?php echo date('Y-m-d'); ?>">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Realizar Pago</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-mQ93pJmXABeyyyxF6iWw5vUuJkBXVQZFlneBOUq0zgzPBmBduvo4M2G9OA7WUlT/"
        crossorigin="anonymous"></script>
</body>
</html>