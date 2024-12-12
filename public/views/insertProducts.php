<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Producto - Tienda Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #333333, #0d47a1); /* Fondo degradado */
            color: #ffffff; /* Texto blanco */
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(to right, #333333, #0d47a1);
            color: #000; /* Texto negro para el nombre de la tienda */
            padding: 15px 20px;
        }

        .header h1 {
            margin: 0; /* Sin margen */
            font-size: 1.8rem; /* Tamaño de fuente */
        }

        .container {
            max-width: 600px;
            margin: 20px auto; /* Margen superior e inferior */
            background-color: #e1f5fe; /* Fondo claro */
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

        input, select, textarea {
            margin-bottom: 15px;
        }

        .form-group input, .form-group select, .form-group textarea {
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 8px rgba(30, 136, 229, 0.5);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Insertar Producto</h1>

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

    <form action="index.php?controller=ProductController&action=insertProduct" method="post" enctype="multipart/form-data">
        <!-- Campos del formulario -->
        <div class="form-group">
            <label for="nombre">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="Nombre" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="Descripcion" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="Precio" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="Stock" required>
        </div>

        <div class="form-group">
            <label for="categoria">Categoría</label>
            <select class="form-control" id="categoria" name="Categoria" required>
                <option value="1">Informática</option>
                <option value="2">Hogar y Cocina</option>
                <option value="3">Electrónica</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de creación</label>
            <input type="date" class="form-control" id="fecha" name="Fecha_creacion" disabled
                   value="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="form-group">
            <label for="imagen">Imagen del producto (opcional)</label>
            <input type="file" class="form-control" id="imagen" name="Imagen">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Insertar Producto</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-mQ93pJmXABeyyyxF6iWw5vUuJkBXVQZFlneBOUq0zgzPBmBduvo4M2G9OA7WUlT/"
        crossorigin="anonymous"></script>
</body>
</html>