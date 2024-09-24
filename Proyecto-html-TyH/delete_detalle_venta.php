<?php
include 'config.php'; // Archivo de conexión a la base de datos

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Preparar y ejecutar la consulta para eliminar el registro
    $sql = "DELETE FROM detalles_de_las_ventas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
}

$conn->close();
?>