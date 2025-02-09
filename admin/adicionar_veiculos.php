<?php
  session_start();
  include '../includes/conexao.php';
  if (!isset($_SESSION['admin'])) {
      header('Location: login.php');
      exit;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $modelo = trim($_POST['modelo']);
      $descricao = trim($_POST['descricao']);
      $preco = trim($_POST['preco']);
      $tipo = $_POST['tipo'];
      
      $imagem = $_FILES['imagem']['name'];
      $target = "imagens/" . basename($imagem);
      
      if (move_uploaded_file($_FILES['imagem']['tmp_name'], $target)) {
          $query = "INSERT INTO veiculos (modelo, descricao, preco, tipo, imagem) VALUES ('$modelo', '$descricao', '$preco', '$tipo', '$imagem')";
          if (mysqli_query($conn, $query)) {
              $mensagem = "Veículo adicionado com sucesso!";
          } else {
              $erro = "Erro ao adicionar veículo.";
          }
      } else {
          $erro = "Erro ao enviar a imagem.";
      }
  }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Veículo</title>
    <link rel="stylesheet" href="../css/adicionar_veiculos.css">
</head>
<body>
    <div class="container">
        <h2>Adicionar Veículo</h2>
        <?php if (isset($mensagem)) echo "<p class='sucesso'>$mensagem</p>"; ?>
        <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
        <form action="veiculos_cadstrados.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="modelo" placeholder="Modelo" required>
            <textarea name="descricao" placeholder="Descrição" required></textarea>
            <input type="number" name="preco" placeholder="Preço (Kz)" required>
            <select name="tipo" required>
                <option value="aluguel">Aluguel</option>
                <option value="venda">Venda</option>
            </select>
            <input type="file" name="imagem" required>
            <button type="submit">Adicionar Veículo</button>
        </form>
        <a href="dashboard.php" class="voltar">Voltar ao Painel</a>
    </div>
</body>
</html>
