<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Propietario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Modificar Propietario</h1>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'bdadhemar');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if (isset($_GET['ci'])) {
        $ci = $_GET['ci'];
        $sql = "SELECT * FROM Propietarios WHERE ci = '$ci'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $propietario = $result->fetch_assoc();
            ?>
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="ci">CI</label>
                            <input type="text" class="form-control" id="ci" name="ci" value="<?php echo $propietario['ci']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $propietario['nombre']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $propietario['apellido']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $propietario['telefono']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $propietario['rol']; ?>" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="main.php?ci=<?php echo $ci; ?>" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
            <?php
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $rol = $_POST['rol'];

        $sql = "UPDATE Propietarios SET nombre = '$nombre', apellido = '$apellido', telefono = '$telefono', rol = '$rol' WHERE ci = '$ci'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='main.php?ci=$ci';</script>";
        } else {
            echo "<div class='alert alert-danger mt-4'>Error al modificar el propietario: " . $conn->error . "</div>";
        }
    }

    $conn->close();
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>