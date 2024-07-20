<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error: Usuario no autenticado");
}

$usuario = $_SESSION['usuario'];
$comentario = $_POST['comentario'];

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "empresa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "INSERT INTO atencion_clientes (usuario, comentario) VALUES ('$usuario', '$comentario')";

if ($conn->query($sql) === TRUE) {

    echo '<html><head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head><body>';
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Comentario enviado",
            text: "Comentario enviado correctamente. En breve te leeremos.",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/pagina/html/atencion_cliente.html";
            }
        });
    </script>';
    echo '</body></html>';
} else {
    echo "Error al guardar el comentario: " . $conn->error;
}

$conn->close();
?>
