<?php
include 'config.php'; // Conexión a la base de datos

$sql = "SELECT * FROM facturacion ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['direccion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['num_presupuesto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
        echo "<td>" . htmlspecialchars($row['precio_unitario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['impuesto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['subtotal']) . "</td>";
        echo "<td>" . htmlspecialchars($row['total']) . "</td>";
        echo "<td><button class='action-button delete-button'><img src='img/elim.png' /></button><button class='action-button update-button'><img src='img/udep.png' /></button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='13'>No hay registros en la tabla de facturación.</td></tr>";
}

$conn->close();
?>