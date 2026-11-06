<?php

// Conexión con la base de datos
$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "registro_nombres"
);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar caracteres
$conexion->set_charset("utf8mb4");

// Verificar si se presionó Guardar
if (isset($_POST['guardar'])) {

    // Recibir el nombre
    $nombre = trim($_POST['nombre']);

    if ($nombre !== "") {

        // Insertar nombre en la tabla personas
        $sql = "INSERT INTO personas (nombre) VALUES (?)";

        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("s", $nombre);

        if ($stmt->execute()) {
            echo "<h2>¡Nombre guardado correctamente!</h2>";
            echo "<p>Nombre registrado: " .
                htmlspecialchars($nombre) . "</p>";
        } else {
            echo "Error al guardar el nombre: " .
                $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Escribe un nombre antes de guardar.";
    }
}

$conexion->close();

?>

<br>
<a href="index.html">Regresar al formulario</a>