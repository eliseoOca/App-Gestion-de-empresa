<?php
include 'config.php'; // Archivo que contiene la configuración de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['comentario'])) {
        $comentario = $_POST['comentario'];

        // Validación y sanitización
        $comentario = $conn->real_escape_string($comentario);

        // Construcción de la consulta INSERT
        $sql = "INSERT INTO comentarios (comentario) VALUES ('$comentario')";

        // Ejecución de la consulta
        if ($conn->query($sql) === TRUE) {
            echo "Comentario guardado correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Cierre de la conexión
        $conn->close();
    } else {
        echo "No se recibió ningún comentario.";
    }
} else {
    echo "Método no permitido";
}
?>
