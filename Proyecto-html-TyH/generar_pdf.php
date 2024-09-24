<?php
require('fpdf/fpdf.php');
include 'config.php'; // Archivo de conexión a la base de datos

// Consultar todos los datos de la tabla
$sql = "SELECT * FROM detalles_de_las_ventas";
$result = $conn->query($sql);

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Título del documento
$pdf->Cell(0, 10, 'Detalle de las Ventas', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Cliente', 1);
$pdf->Cell(30, 10, 'Cantidad', 1);
$pdf->Cell(40, 10, 'Detalle', 1);
$pdf->Cell(40, 10, 'Pre. Compra', 1);
$pdf->Cell(40, 10, 'Pre. Venta', 1);
$pdf->Ln();

// Variables para los totales
$total_precio_compra = 0;
$total_precio_venta = 0;

// Mostrar los datos de la tabla
$pdf->SetFont('Arial', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['cliente'], 1);
        $pdf->Cell(30, 10, $row['cantidad'], 1);
        $pdf->Cell(40, 10, $row['detalle'], 1);
        $pdf->Cell(40, 10, "$" . $row['precio_compra'], 1);
        $pdf->Cell(40, 10, "$" . $row['precio_venta'], 1);
        $pdf->Ln();

        // Sumar al total
        $total_precio_compra += $row['precio_compra'];
        $total_precio_venta += $row['precio_venta'];
    }

    // Mostrar los totales al final
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(70, 10, 'Total Precio Compra:', 1);
    $pdf->Cell(40, 10, "$" . $total_precio_compra, 1);
    $pdf->Ln();
    $pdf->Cell(70, 10, 'Total Precio Venta:', 1);
    $pdf->Cell(40, 10, "$" . $total_precio_venta, 1);
} else {
    $pdf->Cell(0, 10, 'No se encontraron datos', 1, 1, 'C');
}

// Salida del PDF para descargarlo
$pdf->Output('D', 'reporte_ventas.pdf');
?>
