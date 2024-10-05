<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Adicionar Usuario</h1>
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="ci">CI</label>
                    <input type="text" class="form-control" id="ci" name="ci" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="form-control" id="rol" name="rol">
                        <option value="propietario">Propietario</option>
                        <option value="funcionario">Funcionario</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="distrito">Distrito:</label>
                    <select id="distrito" name="distrito" class="form-control">
                        <option value="">Seleccione un distrito</option>
                        <?php
                        // Conexión a la base de datos
                        $conn = new mysqli('localhost', 'root', '', 'bdadhemar');
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Obtener distritos
                        $sql = "SELECT id, nombre FROM Distritos";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="zona">Zona:</label>
                    <select id="zona" name="zona" class="form-control">
                        <option value="">Seleccione una zona</option>
                        <!-- Opciones de zona se llenarán aquí -->
                    </select>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mr-2">Adicionar Usuario</button>
                    <a href="adicionar_usuario.php" class="btn btn-primary">Cancelar</a>
                </div>
            </form>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'bdadhemar');

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $ci = $_POST['ci'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $telefono = $_POST['telefono'];
                $rol = $_POST['rol'];
                $distrito = $_POST['distrito'];
                $zona = $_POST['zona'];

                $sql = "INSERT INTO Propietarios (ci, nombre, apellido, telefono, rol) VALUES ('$ci', '$nombre', '$apellido', '$telefono', '$rol')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                            alert('Usuario añadido exitosamente.');
                            window.location.href='adicionar_usuario.php';
                          </script>";
                } else {
                    echo "<div class='alert alert-danger mt-4'>Error al añadir el usuario: " . $conn->error . "</div>";
                }
            }

            $conn->close();
            ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Cargar zonas cuando se selecciona un distrito
        $('#distrito').change(function() {
            var distritoId = $(this).val();
            if (distritoId) {
                $.ajax({
                    url: 'get_zonas.php',
                    method: 'GET',
                    data: { distrito_id: distritoId },
                    success: function(data) {
                        $('#zona').html('<option value="">Seleccione una zona</option>' + data);
                    }
                });
            } else {
                $('#zona').html('<option value="">Seleccione una zona</option>');
            }
        });
    });
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>