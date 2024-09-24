<?php
include 'config.php'; // Conexión a la base de datos

if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Asegúrate de que el ID sea un número entero

    $sql = "DELETE FROM comentarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Tarea borrada exitosamente.";
    } else {
        echo "Error al borrar la tarea: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No se recibió ningún ID de tarea.";
}

$conn->close();
?>