<?php
include 'config.php'; // Archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
    $cantidad = $_POST['cantidad'];
    $detalle = $_POST['detalle'];
    $precio_compra = $_POST['pc'];
    $precio_venta = $_POST['pv'];

    // Preparar la consulta SQL para actualizar
    $sql = "UPDATE detalles_de_las_ventas SET 
            cliente = ?, 
            cantidad = ?, 
            detalle = ?, 
            precio_compra = ?, 
            precio_venta = ? 
            WHERE id = ?";

    // Preparar y ejecutar la declaración
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('sissii', $cliente, $cantidad, $detalle, $precio_compra, $precio_venta, $id);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
        $stmt->close();
    } else {
        echo 'error';
    }

    $conn->close();
}
?>