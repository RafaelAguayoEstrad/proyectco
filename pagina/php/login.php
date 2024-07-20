<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Procesando Registro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "empresa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];

    $usuario = mysqli_real_escape_string($conn, $usuario);
    $contrasena = mysqli_real_escape_string($conn, $contrasena);

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $usuario;
        echo "<script>
        Swal.fire('¡Bienvenido!', 'Usuario y contraseña correctos', 'success').then(() => {
            window.location.href = '/pagina/html/index.html';
        });
        </script>";
        exit();
    } else {
        echo "<script>
        Swal.fire('¡Error!', 'Usuario y contraseña incorrectos', 'error').then(() => {
            window.location.href = '/pagina/html/login.html';
        });
        </script>";
        exit();
    }
}

$conn->close();
?>

</body>
</html>
