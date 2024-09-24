<?php
include 'config.php'; // Archivo para la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_o_rsocial = $_POST['nombre'];
    $cuit = $_POST['cuit'];
    $telefono = $_POST['telefono'];
    $mail = $_POST['mail'];
    $id = $_POST['proveedor_id'];

    // Validar que el email sea de Gmail
    if (strpos($mail, '@gmail.com') === false) {
        die("El correo electrónico debe ser una dirección de Gmail.");
    }

    if (!empty($id)) {
        // Actualizar el proveedor existente
        $sql = "UPDATE proveedores SET nombre_o_rsocial = ?, cuit = ?, telefono = ?, mail = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siisi", $nombre_o_rsocial, $cuit, $telefono, $mail, $id);
    } else {
        // Insertar un nuevo proveedor
        $sql = "INSERT INTO proveedores (nombre_o_rsocial, cuit, telefono, mail) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siis", $nombre_o_rsocial, $cuit, $telefono, $mail);
    }

    if ($stmt->execute()) {
        // No mostrar ningún mensaje
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>