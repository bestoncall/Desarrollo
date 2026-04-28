<?php include("auth.php"); include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Socios — Biblioteca</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body class="page-socios">

  <header class="page-header">
    <a href="index.php" class="back">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      Panel principal
    </a>
    <span class="brand-label">Biblioteca</span>
  </header>

  <div class="page-hero">
    <div class="page-hero-icon">
      <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="page-hero-text">
      <span>Gestión de miembros</span>
      <h1>Socios</h1>
    </div>
  </div>

  <main class="page-main">

    <p class="section-label">Agregar socio</p>
    <div class="form-card">
      <form action="guardar.php" method="POST">
        <input type="hidden" name="tabla" value="socios">
        <input type="text"  name="nombre"   placeholder="Nombre completo" required>
        <input type="email" name="correo"   placeholder="Correo electrónico">
        <input type="text"  name="telefono" placeholder="Teléfono">
        <button type="submit">Guardar</button>
      </form>
    </div>

    <p class="section-label">Listado de socios</p>
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
          $res = $conn->query("SELECT * FROM socios");
          if ($res->num_rows === 0): ?>
            <tr><td colspan="5" class="table-empty">No hay socios registrados.</td></tr>
          <?php else: while ($r = $res->fetch_assoc()): ?>
            <tr>
              <td><?= $r['id_socio'] ?></td>
              <td><?= htmlspecialchars($r['nombre']) ?></td>
              <td><?= htmlspecialchars($r['correo'] ?? '—') ?></td>
              <td><?= htmlspecialchars($r['telefono'] ?? '—') ?></td>
              <td>
                <a href="editar.php?tabla=socios&id=<?= $r['id_socio'] ?>" class="btn-edit">Actualizar</a>
                <a href="eliminar.php?tabla=socios&id=<?= $r['id_socio'] ?>" class="btn-delete" onclick="return confirm('¿Eliminar este socio?')">Eliminar</a>
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