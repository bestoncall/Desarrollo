<?php include("auth.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca — Panel principal</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body class="page-index">

  <header class="main-header">
    <div class="brand-group">
      <svg class="brand-icon" viewBox="0 0 32 32" fill="none">
        <rect x="4"  y="6" width="6" height="20" rx="1" fill="currentColor" opacity=".7"/>
        <rect x="12" y="4" width="6" height="22" rx="1" fill="currentColor"/>
        <rect x="20" y="7" width="6" height="18" rx="1" fill="currentColor" opacity=".6"/>
      </svg>
      <div>
        <h1>Biblioteca</h1>
        <span>Sistema de gestión</span>
      </div>
    </div>
    <a href="logout.php" class="logout-btn">Cerrar sesión</a>
  </header>

  <div class="index-hero">
    <div class="index-hero-inner">
      <p>Panel principal</p>
      <h2>Bienvenido al sistema</h2>
    </div>
  </div>

  <main class="dashboard">
    <p class="section-label">Módulos</p>

    <div class="nav-grid">

      <a href="libros.php" class="nav-card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        </div>
        <h3>Libros</h3>
        <p>Catálogo y gestión del fondo bibliográfico</p>
        <svg class="card-arrow" viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
      </a>

      <a href="socios.php" class="nav-card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h3>Socios</h3>
        <p>Registro y administración de miembros</p>
        <svg class="card-arrow" viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
      </a>

      <a href="empleados.php" class="nav-card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-4 0v2"/><path d="M8 7V5a2 2 0 0 0-4 0v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
        </div>
        <h3>Empleados</h3>
        <p>Personal y asignación de turnos</p>
        <svg class="card-arrow" viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
      </a>

      <a href="prestamos.php" class="nav-card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
        </div>
        <h3>Préstamos</h3>
        <p>Control de entregas y devoluciones</p>
        <svg class="card-arrow" viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
      </a>

    </div>
  </main>

  <footer class="page-footer">&copy; <?php echo date('Y'); ?> Biblioteca &mdash; Sistema de gestión interna</footer>

</body>
</html>