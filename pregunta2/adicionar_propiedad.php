<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Propiedad</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Adicionar Propiedad</h1>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'bdadhemar');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if (isset($_GET['ci'])) {
        $ci = $_GET['ci'];
        ?>
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="zona">Zona</label>
                        <input type="text" class="form-control" id="zona" name="zona" required>
                    </div>
                    <div class="form-group">
                        <label for="area">Área</label>
                        <input type="text" class="form-control" id="area" name="area" required>
                    </div>
                    <div class="form-group">
                        <label for="Xini">X Inicial</label>
                        <input type="text" class="form-control" id="Xini" name="Xini">
                    </div>
                    <div class="form-group">
                        <label for="Yini">Y Inicial</label>
                        <input type="text" class="form-control" id="Yini" name="Yini">
                    </div>
                    <div class="form-group">
                        <label for="Xfin">X Final</label>
                        <input type="text" class="form-control" id="Xfin" name="Xfin">
                    </div>
                    <div class="form-group">
                        <label for="Yfin">Y Final</label>
                        <input type="text" class="form-control" id="Yfin" name="Yfin">
                    </div>
                    <div class="form-group">
                        <label for="codigo_catastral">Código Catastral</label>
                        <input type="text" class="form-control" id="codigo_catastral" name="codigo_catastral">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success mr-2">Adicionar Propiedad</button>
                        <a href="main.php?ci=<?php echo $ci; ?>" class="btn btn-primary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $zona = $_POST['zona'];
        $area = $_POST['area'];
        $Xini = $_POST['Xini'];
        $Yini = $_POST['Yini'];
        $Xfin = $_POST['Xfin'];
        $Yfin = $_POST['Yfin'];
        $codigo_catastral = $_POST['codigo_catastral'];

        $sql = "INSERT INTO Catastro (ci, zona, area, Xini, Yini, Xfin, Yfin, codigo_catastral) VALUES ('$ci', '$zona', '$area', '$Xini', '$Yini', '$Xfin', '$Yfin', '$codigo_catastral')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='main.php?ci=$ci';</script>";
        } else {
            echo "<div class='alert alert-danger mt-4'>Error al añadir la propiedad: " . $conn->error . "</div>";
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