<?php
$conn = new mysqli('localhost', 'root', '', 'bdadhemar');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Catastro WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success mt-4'>Propiedad eliminada exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger mt-4'>Error al eliminar la propiedad: " . $conn->error . "</div>";
    }
}

$conn->close();
?>
<a href="main.php" class="btn btn-primary mt-4">Volver</a>