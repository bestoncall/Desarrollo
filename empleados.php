<?php include("auth.php"); include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Empleados — Biblioteca</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body class="page-empleados">

  <header class="page-header">
    <a href="index.php" class="back">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      Panel principal
    </a>
    <span class="brand-label">Biblioteca</span>
  </header>

  <div class="page-hero">
    <div class="page-hero-icon">
      <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-4 0v2"/><path d="M8 7V5a2 2 0 0 0-4 0v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
    </div>
    <div class="page-hero-text">
      <span>Gestión de personal</span>
      <h1>Empleados</h1>
    </div>
  </div>

  <main class="page-main">

    <p class="section-label">Agregar empleado</p>
    <div class="form-card">
      <form action="guardar.php" method="POST">
        <input type="hidden" name="tabla" value="empleados">
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="text" name="cargo"  placeholder="Cargo">
        <button type="submit">Guardar</button>
      </form>
    </div>

    <p class="section-label">Listado de empleados</p>
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>ID</th><th>Nombre</th><th>Cargo</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
          $res = $conn->query("SELECT * FROM empleados");
          if ($res->num_rows === 0): ?>
            <tr><td colspan="4" class="table-empty">No hay empleados registrados.</td></tr>
          <?php else: while ($r = $res->fetch_assoc()): ?>
            <tr>
              <td><?= $r['id_empleado'] ?></td>
              <td><?= htmlspecialchars($r['nombre']) ?></td>
              <td><?= !empty($r['cargo']) ? '<span class="cargo-badge">'.htmlspecialchars($r['cargo']).'</span>' : '—' ?></td>
              <td>
                <a href="editar.php?tabla=empleados&id=<?= $r['id_empleado'] ?>" class="btn-edit">Actualizar</a>
                <a href="eliminar.php?tabla=empleados&id=<?= $r['id_empleado'] ?>" class="btn-delete" onclick="return confirm('¿Eliminar este empleado?')">Eliminar</a>
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