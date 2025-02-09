<?php
  session_start();
  include './includes/conexao.php';

  // Buscar todos os veículos cadastrados
  $query = "SELECT * FROM veiculos ORDER BY id DESC";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos Disponíveis</title>
    <link rel="stylesheet" href="css/veiculos.css">
</head>
<body>
    <header>
        <h1>Veículos Disponíveis</h1>
        <a href="index.php" class="voltar">Voltar à Página Inicial</a>
    </header>
    <main>
        <section class="galeria">
            <?php while($veiculo = mysqli_fetch_assoc($result)): ?>
                <div class="veiculo">
                    <img src="imagens/<?php echo $veiculo['imagem']; ?>" alt="<?php echo $veiculo['modelo']; ?>">
                    <h2><?php echo $veiculo['modelo']; ?></h2>
                    <p><?php echo $veiculo['descricao']; ?></p>
                    <p><strong>Preço:</strong> <?php echo number_format($veiculo['preco'], 2, ',', '.'); ?> Kz</p>
                    <p><strong>Tipo:</strong> <?php echo ucfirst($veiculo['tipo']); ?></p>
                    <a href="detalhes.php?id=<?php echo $veiculo['id']; ?>" class="btn-detalhes">Ver Detalhes</a>
                </div>
            <?php endwhile; ?>
        </section>
    </main>
</body>
</html>
