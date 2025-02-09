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

  // Buscar reservas do usuário logado
  $query = "SELECT veiculos.modelo, veiculos.imagem, reservas.data_reserva 
            FROM reservas 
            INNER JOIN veiculos ON reservas.veiculo_id = veiculos.id 
            WHERE reservas.usuario_id = '$user_id' 
            ORDER BY reservas.data_reserva DESC";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Reservas</title>
    <link rel="stylesheet" href="css/reservas.css">
</head>
<body>
    <header>
        <h1>Minhas Reservas</h1>
        <a href="index.php" class="voltar">Voltar à Página Inicial</a>
    </header>
    <main>
        <section class="lista-reservas">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while($reserva = mysqli_fetch_assoc($result)): ?>
                    <div class="reserva">
                        <img src="imagens/<?php echo $reserva['imagem']; ?>" alt="<?php echo $reserva['modelo']; ?>">
                        <h2><?php echo $reserva['modelo']; ?></h2>
                        <p><strong>Data da Reserva:</strong> <?php echo date('d/m/Y', strtotime($reserva['data_reserva'])); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhuma reserva encontrada.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
