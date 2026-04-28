<?php include("auth.php"); include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Préstamos — Biblioteca</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body class="page-prestamos">

  <header class="page-header">
    <a href="index.php" class="back">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      Panel principal
    </a>
    <span class="brand-label">Biblioteca</span>
  </header>

  <div class="page-hero">
    <div class="page-hero-icon">
      <svg viewBox="0 0 24 24"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
    </div>
    <div class="page-hero-text">
      <span>Control de circulación</span>
      <h1>Préstamos</h1>
    </div>
  </div>

  <main class="page-main wide">

    <p class="section-label">Registrar préstamo</p>
    <div class="form-card">
      <form action="guardar.php" method="POST">
        <input type="hidden" name="tabla" value="prestamos">
        <input type="number" name="id_libro"         placeholder="ID Libro"    min="1" required>
        <input type="number" name="id_socio"         placeholder="ID Socio"    min="1" required>
        <input type="number" name="id_empleado"      placeholder="ID Empleado" min="1">
        <input type="date"   name="fecha_prestamo"   title="Fecha de préstamo">
        <input type="date"   name="fecha_devolucion" title="Fecha de devolución">
        <button type="submit">Guardar</button>
      </form>
    </div>

    <p class="section-label">Historial de préstamos</p>
    <div class="table-wrap scrollable">
      <table class="min-width">
        <thead>
          <tr><th>ID</th><th>Libro</th><th>Socio</th><th>Empleado</th><th>Fecha préstamo</th><th>Fecha devolución</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
          $res = $conn->query("SELECT * FROM prestamos");
          if ($res->num_rows === 0): ?>
            <tr><td colspan="7" class="table-empty">No hay préstamos registrados.</td></tr>
          <?php else: while ($r = $res->fetch_assoc()): ?>
            <tr>
              <td><?= $r['id_prestamo'] ?></td>
              <td><?= $r['id_libro'] ?></td>
              <td><?= $r['id_socio'] ?></td>
              <td><?= $r['id_empleado'] ?></td>
              <td><?= $r['fecha_prestamo'] ?></td>
              <td><?= !empty($r['fecha_devolucion']) ? '<span class="badge badge-ok">'.$r['fecha_devolucion'].'</span>' : '<span class="badge badge-pending">Pendiente</span>' ?></td>
              <td>
                <a href="editar.php?tabla=prestamos&id=<?= $r['id_prestamo'] ?>" class="btn-edit">Actualizar</a>
                <a href="eliminar.php?tabla=prestamos&id=<?= $r['id_prestamo'] ?>" class="btn-delete" onclick="return confirm('¿Eliminar este préstamo?')">Eliminar</a>
              </td>
            </tr>
          <?php endwhile; endif; ?>
        </tbody>
      </table>
    </div>

  </main>
  <footer class="page-footer">&copy; <?php echo date('Y'); ?> Biblioteca — Sistema de gestión interna</footer>
</body>
</html>