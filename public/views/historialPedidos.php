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

        table {
            background-color: #e1f5fe;
            border: 1px solid #b3e5fc;
        }

        th {
            background-color: #1e88e5;
            color: #000000; /* Cambiado a negro */
        }

        th, td {
            text-align: center;
            vertical-align: middle;
        }

        td {
            border-top: 1px solid #b3e5fc;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Listado de Pedidos</h1>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id_pedido</th>
                    <th>Id_usuario</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $pedidos) {
                    echo "<tr>
                        <td>" . htmlspecialchars($pedidos['id_pedido']) . "</td>
                        <td>" . htmlspecialchars($pedidos['id_usuario']) . "</td>
                        <td>" . htmlspecialchars($pedidos['fecha']) . "</td>

                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>