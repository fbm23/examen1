<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'funcionario') {
    header("Location: login.php");
    exit();
}

// Manejar el cierre de sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Propietarios y Propiedades</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Propietarios y Propiedades</h1>
        <a href="?logout=true" class="btn btn-danger">Cerrar Sesión</a>
    </div>
    <div class="mb-4">
        <a href="adicionar_usuario.php" class="btn btn-success">Adicionar Propietario</a>
    </div>
    <?php
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'bdadhemar');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener lista de propietarios
    $sql = "SELECT ci, nombre, apellido FROM Propietarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form method='POST' action='' class='mb-4'>";
        echo "<div class='form-group'>";
        echo "<label for='ci'>Seleccione un Propietario:</label>";
        echo "<select name='ci' class='form-control' id='ci'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['ci'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
        }
        echo "</select>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Seleccionar</button>";
        echo "</form>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ci'])) {
        $ci = $_POST['ci'];
        
        // Obtener datos del propietario seleccionado
        $sql = "SELECT * FROM Propietarios WHERE ci = '$ci'";
        $propietario = $conn->query($sql)->fetch_assoc();
        
        if ($propietario) {
            echo "<h2>Datos del Propietario</h2>";
            echo "<div class='row'>";
            echo "<div class='col-md-6'>";
            echo "<ul class='list-group mb-4'>";
            echo "<li class='list-group-item'>CI: " . $propietario['ci'] . "</li>";
            echo "<li class='list-group-item'>Nombre: " . $propietario['nombre'] . "</li>";
            echo "<li class='list-group-item'>Apellido: " . $propietario['apellido'] . "</li>";
            echo "</ul>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo "<li class='list-group-item'>Teléfono: " . $propietario['telefono'] . "</li>";
            echo "<li class='list-group-item'>Rol: " . $propietario['rol'] . "</li>";
            echo "<a href='modificar_usuario.php?ci=" . $propietario['ci'] . "' class='btn btn-warning'>Modificar Propietario</a> ";
            echo "<a href='eliminar_usuario.php?ci=" . $propietario['ci'] . "' class='btn btn-danger'>Eliminar Propietario</a><br><br>";
            echo "</div>";
            echo "</div>";
        }

        // Obtener propiedades del propietario seleccionado
        $sql = "SELECT * FROM Catastro WHERE ci = '$ci'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Propiedades</h2>";
            echo "<br><a href='adicionar_propiedad.php?ci=" . $ci . "' class='btn btn-success'>Adicionar Propiedad</a>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>ID</th><th>Zona</th><th>Área</th><th>Coordenadas</th><th>Código Catastral</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['zona'] . "</td>";
                echo "<td>" . $row['area'] . "</td>";
                echo "<td>(" . $row['Xini'] . ", " . $row['Yini'] . ") - (" . $row['Xfin'] . ", " . $row['Yfin'] . ")</td>";
                echo "<td>" . $row['codigo_catastral'] . "</td>";
                echo "<td>";
                echo "<a href='modificar_propiedad.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Modificar</a> ";
                echo "<a href='eliminar_propiedad.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No se encontraron propiedades para este propietario.</p>";
            echo "<br><a href='adicionar_propiedad.php?ci=" . $ci . "' class='btn btn-success'>Adicionar Propiedad</a>";
        }

       
    }

    $conn->close();
    ?>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>