<?php include("conexion.php"); ?>
<?php
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión — Biblioteca</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body class="page-login">

  <div class="login-page">

    <div class="login-brand">
      <svg class="login-brand-icon" viewBox="0 0 32 32" fill="none">
        <rect x="4"  y="6" width="6" height="20" rx="1" fill="currentColor" opacity=".7"/>
        <rect x="12" y="4" width="6" height="22" rx="1" fill="currentColor"/>
        <rect x="20" y="7" width="6" height="18" rx="1" fill="currentColor" opacity=".6"/>
      </svg>
      <span class="login-brand-name">Biblioteca</span>
    </div>

    <div class="login-card">
      <h2>Bienvenido</h2>
      <p class="login-sub">Ingresa tus credenciales para continuar</p>

      <?php if (isset($error)): ?>
        <p class="login-error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="POST">
        <div class="field">
          <label>Usuario</label>
          <input type="text" name="usuario" placeholder="Nombre de usuario" required autofocus>
        </div>
        <div class="field">
          <label>Contraseña</label>
          <input type="password" name="contrasena" placeholder="Contraseña" required>
        </div>
        <button type="submit">Ingresar</button>
      </form>
    </div>

    <p class="login-footer">&copy; <?php echo date('Y'); ?> Biblioteca — Sistema de gestión interna</p>

  </div>

</body>
</html>