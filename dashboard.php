<?php
  session_start();
  include './includes/conexao.php';

  if (!isset($_SESSION['user'])) {
      header('Location: login.php');
      exit;
  }

  $email = $_SESSION['user'];
  $query_user = "SELECT id, nome FROM usuarios WHERE email='$email'";
  $result_user = mysqli_query($conn, $query_user);
  $user = mysqli_fetch_assoc($result_user);
  $user_id = $user['id'];
  $nome = $user['nome'];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Cliente</title>
    <link rel="stylesheet" href="css/dashboard-cliente.css">
</head>
<body>
    <header>
        <h1>Bem-vindo, <?php echo $nome; ?>!</h1>
        <a href="logout.php" class="btn-sair">Sair</a>
    </header>
    <main>
        <section class="opcoes">
            <a href="reservas.php" class="btn">Minhas Reservas</a>
            <a href="compras.php" class="btn">Minhas Compras</a>
        </section>
    </main>
</body>
</html>
