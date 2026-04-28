<?php include("auth.php"); include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Libros — Biblioteca</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body class="page-libros">

  <header class="page-header">
    <a href="index.php" class="back">
      <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      Panel principal
    </a>
    <span class="brand-label">Biblioteca</span>
  </header>

  <div class="page-hero">
    <div class="page-hero-icon">
      <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
    </div>
    <div class="page-hero-text">
      <span>Gestión de colección</span>
      <h1>Libros</h1>
    </div>
  </div>

  <main class="page-main">

    <p class="section-label">Agregar libro</p>
    <div class="form-card">
      <form action="guardar.php" method="POST">
        <input type="hidden" name="tabla" value="libros">
        <input type="text"   name="titulo"     placeholder="Título" required>
        <input type="text"   name="autor"      placeholder="Autor">
        <input type="text"   name="genero"     placeholder="Género">
        <input type="number" name="disponible" placeholder="Disponible: 1=Sí, 0=No" min="0" max="1">
        <button type="submit">Guardar</button>
      </form>
    </div>

    <p class="section-label">Catálogo</p>
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>ID</th><th>Título</th><th>Autor</th><th>Género</th><th>Disponible</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
          $result = $conn->query("SELECT * FROM libros");
          if ($result->num_rows === 0): ?>
            <tr><td colspan="6" class="table-empty">No hay libros registrados.</td></tr>
          <?php else: while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id_libro'] ?></td>
              <td><?= htmlspecialchars($row['titulo']) ?></td>
              <td><?= htmlspecialchars($row['autor']) ?></td>
              <td><?= htmlspecialchars($row['genero']) ?></td>
              <td><?= $row['disponible']==1 ? '<span class="badge badge-yes">Disponible</span>' : '<span class="badge badge-no">Prestado</span>' ?></td>
              <td>
                <a href="editar.php?tabla=libros&id=<?= $row['id_libro'] ?>" class="btn-edit">Actualizar</a>
                <a href="eliminar.php?tabla=libros&id=<?= $row['id_libro'] ?>" class="btn-delete" onclick="return confirm('¿Eliminar este libro?')">Eliminar</a>
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