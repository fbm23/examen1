<?php
if (isset($_GET['distrito_id'])) {
    $distritoId = $_GET['distrito_id'];

    $conn = new mysqli('localhost', 'root', '', 'bdadhemar');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT id, nombre FROM Zonas WHERE distrito_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $distritoId);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = "";
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
    }

    echo $options;

    $stmt->close();
    $conn->close();
}
?>