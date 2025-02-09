<?php
  session_start();
  include '../includes/conexao.php';

  if (!isset($_SESSION['admin'])) {
      header('Location: login.php');
      exit;
  }

  // Buscar todos os veículos cadastrados
  $query = "SELECT * FROM veiculos ORDER BY id DESC";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Veículos</title>
    <link rel="stylesheet" href="../css/veiculos_cadastrados.css">
</head>
<body>
    <header>
        <h1>Gerenciar Veículos</h1>
        <a href="dashboard.php" class="voltar">Voltar ao Painel</a>
    </header>
    <main>
        <section class="lista-veiculos">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Modelo</th>
                        <th>Preço</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($veiculo = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $veiculo['id']; ?></td>
                            <td><img src="imagens/<?php echo $veiculo['imagem']; ?>" width="100"></td>
                            <td><?php echo $veiculo['modelo']; ?></td>
                            <td><?php echo number_format($veiculo['preco'], 2, ',', '.'); ?> Kz</td>
                            <td><?php echo ucfirst($veiculo['tipo']); ?></td>
                            <td>
                                <a href="detalhes.php?id=<?php echo $veiculo['id']; ?>" class="btn visualizar">Ver</a>
                                <a href="editar_veiculo.php?id=<?php echo $veiculo['id']; ?>" class="btn editar">Editar</a>
                                <a href="excluir_veiculo.php?id=<?php echo $veiculo['id']; ?>" class="btn excluir" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
