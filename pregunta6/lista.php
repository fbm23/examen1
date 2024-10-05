<?php
header('Content-Type: text/html; charset=UTF-8');

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'bdadhemar');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener la lista de personas por tipo de impuesto
$sql = "
SELECT 
    p.ci,
    p.nombre,
    p.apellido,
    MAX(CASE WHEN LEFT(c.codigo_catastral, 1) = '1' THEN 'Alto' ELSE NULL END) AS Impuesto_Alto,
    MAX(CASE WHEN LEFT(c.codigo_catastral, 1) = '2' THEN 'Medio' ELSE NULL END) AS Impuesto_Medio,
    MAX(CASE WHEN LEFT(c.codigo_catastral, 1) = '3' THEN 'Bajo' ELSE NULL END) AS Impuesto_Bajo
FROM 
    Propietarios p
JOIN 
    Catastro c ON p.ci = c.ci
GROUP BY 
    p.ci, p.nombre, p.apellido;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>CI</th><th>Nombre</th><th>Apellido</th><th>Impuesto Alto</th><th>Impuesto Medio</th><th>Impuesto Bajo</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['ci']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Impuesto_Alto']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Impuesto_Medio']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Impuesto_Bajo']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

$conn->close();
?>