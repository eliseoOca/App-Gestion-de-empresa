<?php
include 'config.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $mail = $_POST['mail'];
    $num_presupuesto = $_POST['presupuesto'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['unitario'];
    $impuesto = $_POST['impuesto'];
    $subtotal = $_POST['subtotal'];
    $total = $_POST['total'];

    $sql = "INSERT INTO facturacion (nombre, direccion, telefono, email, num_presupuesto, fecha, descripcion, cantidad, precio_unitario, impuesto, subtotal, total)
            VALUES ('$nombre', '$direccion', '$telefono', '$mail', '$num_presupuesto', '$fecha', '$descripcion', '$cantidad', '$precio_unitario', '$impuesto', '$subtotal', '$total')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>