<?php
include("auth.php");
include("conexion.php");

$tabla = isset($_POST['tabla']) ? $_POST['tabla'] : '';

if (empty($tabla)) {
    die("Error: tabla no especificada");
}

unset($_POST['tabla']);

$campos = array_keys($_POST);
$valores = array_values($_POST);

$placeholders = implode(",", array_fill(0, count($valores), "?"));
$sql = "INSERT INTO " . $tabla . " (" . implode(",", $campos) . ") VALUES (" . $placeholders . ")";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $types = str_repeat("s", count($valores));
    $stmt->bind_param($types, ...$valores);
    $stmt->execute();
    $stmt->close();
}

header("Location: " . $tabla . ".php");
?>  