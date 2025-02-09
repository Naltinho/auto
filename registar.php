<?php
  session_start();
  include './includes/conexao.php'; // Arquivo de conexão com o banco de dados

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $nome = trim($_POST['nome']);
      $email = trim($_POST['email']);
      $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
      
      // Verificar se o e-mail já está cadastrado
      $verifica = mysqli_query($conn, "SELECT id FROM usuarios WHERE email='$email'");
      if (mysqli_num_rows($verifica) > 0) {
          $erro = "Este e-mail já está cadastrado. Faça login.";
      } else {
          // Inserir novo usuário
          $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
          if (mysqli_query($conn, $query)) {
              $_SESSION['user'] = $email;
              header('Location: dashboard.php');
              exit;
          } else {
              $erro = "Erro ao cadastrar. Tente novamente.";
          }
      }
  }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - AutoRentaCar</title>
    <link rel="stylesheet" href="css/registar.css">
</head>
<body>
    <div class="container">
        <h2>Crie a sua conta</h2>
        <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
        <form action="registar.php" method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Cadastrar</button>
        </form>
        <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
    </div>
</body>
</html>
