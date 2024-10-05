<?php
$conn = new mysqli('localhost', 'root', '', 'bdadhemar');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['ci'])) {
    $ci = $_GET['ci'];
    $sql = "DELETE FROM Propietarios WHERE ci = '$ci'";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success mt-4'>Propietario eliminado exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger mt-4'>Error al eliminar el propietario: " . $conn->error . "</div>";
    }
}

$conn->close();
?>
<a href="main.php" class="btn btn-primary mt-4">Volver</a>