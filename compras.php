<?php
  session_start();
  include './includes/conexao.php';

  if (!isset($_SESSION['user'])) {
      header('Location: login.php');
      exit;
  }

  $email = $_SESSION['user'];
  $query_user = "SELECT id FROM usuarios WHERE email='$email'";
  $result_user = mysqli_query($conn, $query_user);
  $user = mysqli_fetch_assoc($result_user);
  $user_id = $user['id'];

  // Buscar compras do usuário logado
  $query = "SELECT veiculos.modelo, veiculos.imagem, compras.data_compra 
            FROM compras 
            INNER JOIN veiculos ON compras.veiculo_id = veiculos.id 
            WHERE compras.usuario_id = '$user_id' 
            ORDER BY compras.data_compra DESC";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Compras</title>
    <link rel="stylesheet" href="css/compras.css">
</head>
<body>
    <header>
        <h1>Minhas Compras</h1>
        <a href="index.php" class="voltar">Voltar à Página Inicial</a>
    </header>
    <main>
        <section class="lista-compras">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while($compra = mysqli_fetch_assoc($result)): ?>
                    <div class="compra">
                        <img src="imagens/<?php echo $compra['imagem']; ?>" alt="<?php echo $compra['modelo']; ?>">
                        <h2><?php echo $compra['modelo']; ?></h2>
                        <p><strong>Data da Compra:</strong> <?php echo date('d/m/Y', strtotime($compra['data_compra'])); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhuma compra encontrada.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
