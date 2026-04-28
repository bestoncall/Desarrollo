<?php
include("auth.php");
include("conexion.php");

$tabla = $_POST['tabla'] ?? '';
$id    = $_POST['id']    ?? '';

// Validaciones
$tablas_permitidas = ["libros", "socios", "empleados", "prestamos"];
if (!in_array($tabla, $tablas_permitidas)) die("Tabla no válida");
if (!is_numeric($id) || $id <= 0)          die("ID no válido");

// Clave primaria por tabla
$campos_id = [
    "libros"    => "id_libro",
    "socios"    => "id_socio",
    "empleados" => "id_empleado",
    "prestamos" => "id_prestamo"
];
$campo_id = $campos_id[$tabla];

// Campos editables permitidos por tabla (whitelist de seguridad)
$campos_permitidos = [
    "libros"    => ["titulo", "autor", "genero", "disponible"],
    "socios"    => ["nombre", "correo", "telefono"],
    "empleados" => ["nombre", "cargo"],
    "prestamos" => ["id_libro", "id_socio", "id_empleado", "fecha_prestamo", "fecha_devolucion"],
];

$campos = $campos_permitidos[$tabla];

// Construir SET dinámico solo con campos permitidos
$sets   = [];
$valores = [];

foreach ($campos as $campo) {
    if (isset($_POST[$campo])) {
        // Convertir cadena vacía a NULL para campos opcionales de fecha/número
        $val = $_POST[$campo] === '' ? null : $_POST[$campo];
        $sets[]   = "$campo = ?";
        $valores[] = $val;
    }
}

if (empty($sets)) {
    die("No hay campos para actualizar");
}

$valores[] = $id; // Para el WHERE

$sql  = "UPDATE $tabla SET " . implode(", ", $sets) . " WHERE $campo_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

// Tipos: todos como string excepto el id final que es entero
$types = str_repeat("s", count($valores) - 1) . "i";
$stmt->bind_param($types, ...$valores);
$stmt->execute();

if ($stmt->affected_rows >= 0) {
    $stmt->close();
    header("Location: $tabla.php");
    exit();
} else {
    die("Error al actualizar el registro.");
}
?>
