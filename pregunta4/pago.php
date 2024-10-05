<?php
$message = ""; // Variable para almacenar el mensaje

// Verificar si el formulario fue enviado
if (isset($_POST['submit'])) {
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'bdadhemar');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el CI desde el formulario
    $ci = $_POST['ci'];

    // Consulta para obtener el primer código catastral
    $sql = "SELECT codigo_catastral FROM Catastro WHERE ci = '$ci' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el código catastral
        $row = $result->fetch_assoc();
        $codigo_catastral = $row['codigo_catastral'];

        // Enviar el código catastral a la aplicación Java
        $tipoImpuesto = shell_exec("java -cp \"C:\\Users\\oHm\\Documents\\NetBeansProjects\\pregunta4ex1\\build\\classes\" pregunta4ex1.Pregunta4ex1 " . escapeshellarg($codigo_catastral));

        // Preparar el mensaje para mostrar
        $message = "<div class='alert alert-success mt-4'>El tipo de impuesto es: " . htmlspecialchars(trim($tipoImpuesto)) . "</div>";
    } else {
        $message = "<div class='alert alert-danger mt-4'>No se encontró el código catastral para el CI proporcionado.</div>";
    }

    // Cerrar conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pago de Impuestos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Pago de Impuestos de la Propiedad</h1>
        <form method="POST" action="pago.php" class="mx-auto" style="max-width: 500px;">
            <div class="form-group">
                <label for="ci">Ingrese su CI:</label>
                <input type="text" id="ci" name="ci" class="form-control" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" name="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <!-- Contenedor para el mensaje -->
        <div class="mt-4">
            <?php echo $message; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>