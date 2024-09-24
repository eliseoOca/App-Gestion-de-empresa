<?php
include 'config.php';

// Obtener datos del formulario
$cliente = $_POST['cliente'];
$cantidad = $_POST['cantidad'];
$detalle = $_POST['detalle'];
$pc = $_POST['pc'];
$pv = $_POST['pv'];

// Insertar datos en la base de datos
$sql = "INSERT INTO detalles_de_las_ventas (cliente, cantidad, detalle, precio_compra, precio_venta)
        VALUES ('$cliente', $cantidad, '$detalle', $pc, $pv)";

if ($conn->query($sql) === TRUE) {
    // Retornar una respuesta exitosa
    echo 'success';
} else {
    // Retornar un mensaje de error
    echo 'Error: ' . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>