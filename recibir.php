
<?php
// Solo aceptar datos enviados mediante POST.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: formulario.html");
    exit;
}

// Función para mostrar texto de manera segura en HTML.
function limpiar($dato) {
    return htmlspecialchars(
        trim($dato),
        ENT_QUOTES,
        "UTF-8"
    );
}

// Recibir los datos del formulario.
$nombre = limpiar($_POST["nombre"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$preferencia = $_POST["preferencia"] ?? "";
$comentario = limpiar($_POST["comentario"] ?? "");

// Opciones permitidas en el menú de selección.
$opciones = [
    "Ropa de gimnasio",
    "Ropa para correr",
    "Ropa de fútbol",
    "Ropa deportiva casual",
    "Ropa para ciclismo",
    "Otra"
];

// Comprobar los datos obligatorios.
if (
    $nombre === "" ||
    strlen($nombre) > 320 ||
    strlen($correo) > 150 ||
    !filter_var($correo, FILTER_VALIDATE_EMAIL) ||
    !in_array($preferencia, $opciones, true)
) {
    http_response_code(400);
    exit("Los datos no son válidos. Regresa al formulario e inténtalo de nuevo.");
}

// Escapar la preferencia antes de mostrarla.
$preferencia = limpiar($preferencia);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportWear | Respuesta</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <a class="logo" href="index.html">SPORT<span>WEAR</span></a>
</header>

<main class="respuesta">
    <div class="respuesta-tarjeta">
        <p class="etiqueta">¡FORMULARIO RECIBIDO!</p>

        <h1>¡Hola, <?php echo $nombre; ?>!</h1>

        <p>
            Gracias por visitar SportWear y compartir tu opinión
            con nosotros.
        </p>

        <p>
            Tu preferencia deportiva es:
            <strong><?php echo $preferencia; ?></strong>.
        </p>

        <?php if ($comentario !== ""): ?>
            <p>
                <strong>Tu comentario:</strong><br>
                <?php echo $comentario; ?>
            </p>
        <?php endif; ?>

        <a class="boton" href="index.html">VOLVER AL INICIO</a>
    </div>
</main>

<footer>
    <p>SportWear | Gracias por participar</p>
</footer>

</body>
</html>
