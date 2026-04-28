<?php
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

$host = "localhost";
$user_db = "root";
$pass_db = "";
$db = "biblioteca";

$conn = new mysqli($host, $user_db, $pass_db, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    // Obtener el hash y salt del usuario
    $sql = "SELECT password_hash, salt FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_hash = $row['password_hash'];
        $salt = $row['salt'];
        
        // Verificar la contraseña con el hash almacenado
        if (password_verify($contrasena . $salt, $stored_hash)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos para: $usuario";
        }
    } else {
        $error = "Usuario no encontrado: $usuario";
    }
}
?>