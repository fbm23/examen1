<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Iniciar Sesión</h1>
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nombre">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="ci">Contraseña (CI)</label>
                    <input type="password" class="form-control" id="ci" name="ci" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </form>
            <?php
            session_start();
            $conn = new mysqli('localhost', 'root', '', 'bdadhemar');

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = $_POST['nombre'];
                $ci = $_POST['ci'];

                $sql = "SELECT * FROM Propietarios WHERE nombre = '$nombre' AND ci = '$ci' AND rol = 'funcionario'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    $_SESSION['usuario'] = $user;
                    header("Location: main.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger mt-4'>Nombre de usuario o contraseña incorrectos, o no tienes permiso para acceder.</div>";
                }
            }

            $conn->close();
            ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>