<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Propiedad</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Modificar Propiedad</h1>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'bdadhemar');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Catastro WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $propiedad = $result->fetch_assoc();
            ?>
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="zona">Zona</label>
                            <input type="text" class="form-control" id="zona" name="zona" value="<?php echo $propiedad['zona']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="area">Área</label>
                            <input type="text" class="form-control" id="area" name="area" value="<?php echo $propiedad['area']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Xini">X Inicial</label>
                            <input type="text" class="form-control" id="Xini" name="Xini" value="<?php echo $propiedad['Xini']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Yini">Y Inicial</label>
                            <input type="text" class="form-control" id="Yini" name="Yini" value="<?php echo $propiedad['Yini']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Xfin">X Final</label>
                            <input type="text" class="form-control" id="Xfin" name="Xfin" value="<?php echo $propiedad['Xfin']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Yfin">Y Final</label>
                            <input type="text" class="form-control" id="Yfin" name="Yfin" value="<?php echo $propiedad['Yfin']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="codigo_catastral">Código Catastral</label>
                            <input type="text" class="form-control" id="codigo_catastral" name="codigo_catastral" value="<?php echo $propiedad['codigo_catastral']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
            <?php
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $zona = $_POST['zona'];
        $area = $_POST['area'];
        $Xini = $_POST['Xini'];
        $Yini = $_POST['Yini'];
        $Xfin = $_POST['Xfin'];
        $Yfin = $_POST['Yfin'];
        $codigo_catastral = $_POST['codigo_catastral'];

        $sql = "UPDATE Catastro SET zona = '$zona', area = '$area', Xini = '$Xini', Yini = '$Yini', Xfin = '$Xfin', Yfin = '$Yfin', codigo_catastral = '$codigo_catastral' WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success mt-4'>Propiedad modificada exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger mt-4'>Error al modificar la propiedad: " . $conn->error . "</div>";
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