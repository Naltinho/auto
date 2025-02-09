<?php
  session_start();
  include 'conexao.php';

  if (!isset($_GET['id'])) {
      header('Location: veiculos.php');
      exit;
  }

  $veiculo_id = $_GET['id'];
  $query = "SELECT * FROM veiculos WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "i", $veiculo_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $veiculo = mysqli_fetch_assoc($result);

  if (!$veiculo) {
      header('Location: veiculos.php');
      exit;
  }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Veículo</title>
    <link rel="stylesheet" href="css/detalhes.css">
</head>
<body>
    <header>
        <h1>Detalhes do Veículo</h1>
        <a href="veiculos.php" class="voltar">Voltar</a>
    </header>
    <main>
        <section class="detalhes">
            <img src="imagens/<?php echo $veiculo['imagem']; ?>" alt="<?php echo $veiculo['modelo']; ?>">
            <h2><?php echo $veiculo['modelo']; ?></h2>
            <p><?php echo $veiculo['descricao']; ?></p>
            <p><strong>Preço:</strong> <?php echo number_format($veiculo['preco'], 2, ',', '.'); ?> Kz</p>
            <p><strong>Tipo:</strong> <?php echo ucfirst($veiculo['tipo']); ?></p>
            
            <?php if ($veiculo['tipo'] == 'aluguel'): ?>
                <a href="reservar.php?id=<?php echo $veiculo['id']; ?>" class="btn-alugar">Alugar</a>
            <?php else: ?>
                <a href="comprar.php?id=<?php echo $veiculo['id']; ?>" class="btn-comprar">Comprar</a>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
