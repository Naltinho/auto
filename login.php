<?php
  session_start();
  include './includes/conexao.php'; // Conexão com o banco de dados

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = trim($_POST['email']);
      $senha = trim($_POST['senha']);
      
      // Verificar usuário no banco de dados
      $query = "SELECT * FROM usuarios WHERE email='$email'";
      $result = mysqli_query($conn, $query);
      
      if (mysqli_num_rows($result) > 0) {
          $usuario = mysqli_fetch_assoc($result);
          if (password_verify($senha, $usuario['senha'])) {
              $_SESSION['user'] = $usuario['email'];
              header('Location: dashboard.php');
              exit;
          } else {
              $erro = "Senha incorreta. Tente novamente.";
          }
      } else {
          $erro = "Usuário não encontrado. Registre-se primeiro.";
      }
  }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AutoRentaCar</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="registar.php">Cadastre-se</a></p>
    </div>
</body>
</html>
