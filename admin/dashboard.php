<?php
  session_start();
  include '../includes/conexao.php';
  if (!isset($_SESSION['admin'])) {
      header('Location: login.php');
      exit;
  }

  // Contadores para dashboard
  $total_usuarios = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM usuarios"))['total'];
  $total_veiculos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM veiculos"))['total'];
  $total_reservas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservas"))['total'];
  $total_compras = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM compras"))['total'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/dashboard-admin.css">
</head>
<body>
    <header>
        <h1>Painel do Administrador</h1>
        <a href="logout.php" class="btn-sair">Sair</a>
    </header>
    <main>
        <section class="cards">
            <div class="card">
                <h2>Usuários</h2>
                <p><?php echo $total_usuarios; ?></p>
            </div>
            <div class="card">
                <h2>Veículos</h2>
                <p><?php echo $total_veiculos; ?></p>
            </div>
            <div class="card">
                <h2>Reservas</h2>
                <p><?php echo $total_reservas; ?></p>
            </div>
            <div class="card">
                <h2>Compras</h2>
                <p><?php echo $total_compras; ?></p>
            </div>
        </section>
        <section class="acoes">
            <a href="adicionar_veiculos.php" class="btn">Gerenciar Veículos</a>
            <a href="clientes.php" class="btn">Ver Clientes</a>
        </section>
    </main>
</body>
</html>
