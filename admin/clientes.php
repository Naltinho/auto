<?php
  session_start();
  include '../includes/conexao.php';

  if (!isset($_SESSION['admin'])) {
      header('Location: login.php');
      exit;
  }

  // Buscar todos os clientes cadastrados
  $query = "SELECT id, nome, email, criado_em FROM usuarios ORDER BY criado_em DESC";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="../css/clientes.css">
</head>
<body>
    <header>
        <h1>Clientes Cadastrados</h1>
        <a href="dashboard.php" class="voltar">Voltar ao Painel</a>
    </header>
    <main>
        <section class="tabela-clientes">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data de Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($cliente = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $cliente['id']; ?></td>
                            <td><?php echo $cliente['nome']; ?></td>
                            <td><?php echo $cliente['email']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($cliente['criado_em'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
