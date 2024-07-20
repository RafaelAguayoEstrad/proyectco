<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Procesando Registro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<?php
$servername = "127.0.0.1"; 
$username = "root";
$password = ""; 
$dbname = "empresa"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $password = $_POST["password"]; 
    $confirm_password = $_POST["confirm_password"];

    if ($password != $confirm_password) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas no coinciden'
            }).then(function() {
                window.history.back();
            });
        </script>";
    } else {

        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' OR correo='$correo'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
 
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El usuario o el correo ya existen'
                }).then(function() {
                    window.history.back();
                });
            </script>";
        } else {

            $sql = "INSERT INTO usuarios (usuario, correo, password) VALUES ('$usuario', '$correo', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: 'Usuario registrado exitosamente'
                    }).then(function() {
                        window.location.href = '/pagina/html/login.html';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al registrar el usuario: " . $conn->error . "'
                    }).then(function() {
                        window.history.back();
                    });
                </script>";
            }
        }
    }
}

$conn->close();
?>


</body>
</html>
