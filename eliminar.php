<?php
include("auth.php");
include("conexion.php");

$tabla = $_GET['tabla'] ?? '';
$id = $_GET['id'] ?? '';

if (empty($tabla) || empty($id) || !is_numeric($id)) {
    die("Parámetros inválidos");
}

$columna = "id_" . substr($tabla, 0, -1);

// Verificar restricciones de clave foránea antes de eliminar
if ($tabla == 'socios') {
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM prestamos WHERE id_socio = ?");
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();
    if ($count > 0) {
        die("No se puede eliminar el socio porque tiene préstamos asociados.");
    }
} elseif ($tabla == 'libros') {
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM prestamos WHERE id_libro = ?");
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();
    if ($count > 0) {
        die("No se puede eliminar el libro porque tiene préstamos asociados.");
    }
}

try {
    $stmt = $conn->prepare("DELETE FROM $tabla WHERE $columna = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: $tabla.php");
    } else {
        die("Error al eliminar el registro. Posiblemente no existe.");
    }

    $stmt->close();
} catch (mysqli_sql_exception $e) {
    die("Error al eliminar el registro: " . $e->getMessage());
}
?>