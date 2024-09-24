<?php
include 'config.php'; // Conexión a la base de datos

$id = isset($_POST['id']) ? $_POST['id'] : null;

if ($id !== null) {
    $sql = "DELETE FROM facturacion WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Registro eliminado con éxito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el registro']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID no definido']);
}

$conn->close();
?>