<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #000000, #00008B); /* Fondo de degradado lateral de negro a azul oscuro */
            color: #333333; /* Texto oscuro */
            padding-top: 20px; /* Añadir espacio en la parte superior */
            font-family: 'Arial', sans-serif; /* Fuente sencilla y clara */
        }

        .container {
            background-color: #ffffff; /* Fondo blanco */
            border: 1px solid #b3e5fc; /* Marco con color de borde azul cielo */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Sombra */
            padding: 30px; /* Espaciado interno mayor */
            margin: 40px auto; /* Centrar el contenedor con mayor margen superior */
            max-width: 900px; /* Ajustar ancho máximo del contenedor */
        }

        h2 {
            color: #0277bd; /* Título en azul oscuro */
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px; /* Aumentar el tamaño del texto para mayor legibilidad */
            line-height: 1.6;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #d32f2f; /* Color rojo oscuro para el precio */
            margin-top: 15px;
        }

        .btn-volver {
            background-color: #0277bd; /* Color de fondo más oscuro para el botón */
            color: #ffffff; /* Texto blanco */
            border-color: #0277bd; /* Borde del botón */
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-volver:hover {
            background-color: #01579b; /* Color de fondo más oscuro al pasar el ratón */
            border-color: #01579b; /* Borde del botón al pasar el ratón */
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px; /* Espaciado debajo de la imagen */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para la imagen */
        }

        .text-center {
            text-align: center;
        }

        /* Ajustes para pantallas más pequeñas */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .btn-volver {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <!-- Mostrar la imagen del producto -->
                <?php 
                $imagen_ruta = 'img/producto' . $data['id_producto'] . '.jpg'; // Construir la ruta de la imagen
                if (file_exists($imagen_ruta)) {
                    echo '<img src="' . htmlspecialchars($imagen_ruta) . '" alt="' . $data['nombre'] . '" class="img-fluid">';
                } else {
                    echo '<p>Imagen no disponible</p>';
                }
                ?>
            </div>
            <div class="col-md-6">
                <!-- Mostrar la descripción y el precio del producto -->
                <h2><?php echo $data['nombre']; ?></h2>
                <p><?php echo $data['descripcion']; ?></p>
                <p class="price">Precio: <?php echo $data['precio']; ?>€</p>
                <a href="index.php?controller=ProductController&action=getAllProducts" class="btn btn-volver">Volver Atrás</a>
            </div>
        </div>
    </div>
</body>

</html>