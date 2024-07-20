<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "empresa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $direccion = $_POST['direccion'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $usuario = $_POST['usuario'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $metodo_pago = $_POST['metodo_pago'];
    $numero_pago = null; 
    $total = 0;

    foreach ($_SESSION['carrito'] as $item) {
        $total += $item['precio'];
    }

    $sql = "INSERT INTO pagos (direccion_del_cliente, nombre, apellido_paterno, apellido_materno, usuario, telefono, correo_electronico, metodo_pago, numero_pago, total) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssd', $direccion, $nombre, $apellido_paterno, $apellido_materno, $usuario, $telefono, $correo_electronico, $metodo_pago, $numero_pago, $total);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Vaciar el carrito
    unset($_SESSION['carrito']);

    header('Location: /pagina/html/index.html');
    exit();
}
?>

