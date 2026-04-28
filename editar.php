<?php include("auth.php"); include("conexion.php"); ?>
<?php
$tabla = $_GET['tabla'] ?? '';
$id    = $_GET['id']    ?? '';

$tablas_permitidas = ["libros", "socios", "empleados", "prestamos"];
if (!in_array($tabla, $tablas_permitidas)) die("Tabla no válida");
if (!is_numeric($id) || $id <= 0)          die("ID no válido");

$campos_id = [
    "libros"    => "id_libro",
    "socios"    => "id_socio",
    "empleados" => "id_empleado",
    "prestamos" => "id_prestamo"
];
$campo_id = $campos_id[$tabla];

$stmt = $conn->prepare("SELECT * FROM $tabla WHERE $campo_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$datos = $stmt->get_result()->fetch_assoc();
if (!$datos) die("Registro no encontrado");

$titulos    = ["libros"=>"Libros","socios"=>"Socios","empleados"=>"Empleados","prestamos"=>"Préstamos"];
$subtitulos = ["libros"=>"Gestión de colección","socios"=>"Gestión de miembros","empleados"=>"Gestión de personal","prestamos"=>"Control de circulación"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar <?= $titulos[$tabla] ?> — Biblioteca</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body class="page-<?= $tabla ?>">

  <header class="page-header">
    <a href="<?= $tabla ?>.php" class="back">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      Volver a <?= $titulos[$tabla] ?>
    </a>
    <span class="brand-label">Biblioteca</span>
  </header>

  <div class="page-hero">
    <div class="page-hero-icon">
      <?php if ($tabla === 'libros'): ?>
        <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
      <?php elseif ($tabla === 'socios'): ?>
        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      <?php elseif ($tabla === 'empleados'): ?>
        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-4 0v2"/><path d="M8 7V5a2 2 0 0 0-4 0v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
      <?php else: ?>
        <svg viewBox="0 0 24 24"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
      <?php endif; ?>
    </div>
    <div class="page-hero-text">
      <span><?= $subtitulos[$tabla] ?></span>
      <h1>Editar — <?= $titulos[$tabla] ?> #<?= htmlspecialchars($id) ?></h1>
    </div>
  </div>

  <main class="page-main narrow">
    <p class="section-label">Modificar datos</p>
    <div class="form-card form-edit">
      <form action="actualizar.php" method="POST">
        <input type="hidden" name="tabla" value="<?= htmlspecialchars($tabla) ?>">
        <input type="hidden" name="id"    value="<?= htmlspecialchars($id) ?>">

        <?php if ($tabla === 'libros'): ?>
          <div class="field">
            <label>Título</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($datos['titulo']) ?>" placeholder="Título del libro" required>
          </div>
          <div class="field">
            <label>Autor</label>
            <input type="text" name="autor" value="<?= htmlspecialchars($datos['autor'] ?? '') ?>" placeholder="Nombre del autor">
          </div>
          <div class="field">
            <label>Género</label>
            <input type="text" name="genero" value="<?= htmlspecialchars($datos['genero'] ?? '') ?>" placeholder="Género literario">
          </div>
          <div class="field">
            <label>Disponibilidad</label>
            <select name="disponible">
              <option value="1" <?= $datos['disponible'] == 1 ? 'selected' : '' ?>>Disponible</option>
              <option value="0" <?= $datos['disponible'] == 0 ? 'selected' : '' ?>>Prestado</option>
            </select>
          </div>

        <?php elseif ($tabla === 'socios'): ?>
          <div class="field">
            <label>Nombre completo</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($datos['nombre']) ?>" placeholder="Nombre completo" required>
          </div>
          <div class="field">
            <label>Correo electrónico</label>
            <input type="email" name="correo" value="<?= htmlspecialchars($datos['correo'] ?? '') ?>" placeholder="correo@ejemplo.com">
          </div>
          <div class="field">
            <label>Teléfono</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($datos['telefono'] ?? '') ?>" placeholder="Número de contacto">
          </div>

        <?php elseif ($tabla === 'empleados'): ?>
          <div class="field">
            <label>Nombre completo</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($datos['nombre']) ?>" placeholder="Nombre completo" required>
          </div>
          <div class="field">
            <label>Cargo</label>
            <input type="text" name="cargo" value="<?= htmlspecialchars($datos['cargo'] ?? '') ?>" placeholder="Cargo del empleado">
          </div>

        <?php elseif ($tabla === 'prestamos'): ?>
          <div class="field">
            <label>ID Libro</label>
            <input type="number" name="id_libro" value="<?= htmlspecialchars($datos['id_libro']) ?>" min="1" required>
          </div>
          <div class="field">
            <label>ID Socio</label>
            <input type="number" name="id_socio" value="<?= htmlspecialchars($datos['id_socio']) ?>" min="1" required>
          </div>
          <div class="field">
            <label>ID Empleado</label>
            <input type="number" name="id_empleado" value="<?= htmlspecialchars($datos['id_empleado'] ?? '') ?>" min="1">
          </div>
          <div class="field">
            <label>Fecha de préstamo</label>
            <input type="date" name="fecha_prestamo" value="<?= htmlspecialchars($datos['fecha_prestamo'] ?? '') ?>">
          </div>
          <div class="field">
            <label>Fecha de devolución</label>
            <input type="date" name="fecha_devolucion" value="<?= htmlspecialchars($datos['fecha_devolucion'] ?? '') ?>">
          </div>
        <?php endif; ?>

        <div class="btn-row">
          <a href="<?= $tabla ?>.php" class="btn-cancel">Cancelar</a>
          <button type="submit">Guardar cambios</button>
        </div>
      </form>
    </div>
  </main>

  <footer class="page-footer">&copy; <?php echo date('Y'); ?> Biblioteca — Sistema de gestión interna</footer>
</body>
</html>