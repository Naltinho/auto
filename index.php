<?php
  session_start();
  include './includes/conexao.php'; // Certifique-se de que este arquivo contém a conexão com o banco de dados

  // Buscar os 4 veículos em destaque adicionados pelo admin
  $query = "SELECT * FROM veiculos ORDER BY id DESC LIMIT 4";
  $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoRentaCar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1><span>Auto</span>RentaCar</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="veiculos.php">Veículos</a></li>
                    <?php if(isset($_SESSION['user'])): ?>
                        <li><a href="perfil.php">Perfil</a></li>
                        <li><a href="logout.php" class="btn-sair">Sair</a></li>
                    <?php else: ?>
                        <li><a href="login.php" class="btn-login">Entrar</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        <section class="hero">
            <h2>Encontre o veículo perfeito para si</h2>
            <p>Aluguer e venda de automóveis com as melhores condições do mercado</p>
            <form action="veiculos.php" method="GET">
                <input type="text" name="buscar" placeholder="Pesquisar veículo...">
                <select name="tipo">
                    <option value="">Todos os Tipos</option>
                    <option value="carro">Carros</option>
                    <option value="moto">Motos</option>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </section>
        
        <section class="destaques">
            <h2>Veículos em Destaque</h2>
            <div class="container-veiculos">
                <?php while($veiculo = mysqli_fetch_assoc($result)): ?>
                    <div class="item">
                        <img src="imagens/<?php echo $veiculo['imagem']; ?>" alt="<?php echo $veiculo['modelo']; ?>">
                        <h3><?php echo $veiculo['modelo']; ?></h3>
                        <p><?php echo $veiculo['descricao']; ?></p>
                        <p><strong>Preço:</strong> <?php echo $veiculo['preco']; ?> €</p>
                        <a href="detalhes.php?id=<?php echo $veiculo['id']; ?>" class="btn-detalhes">Ver detalhes</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 AutoRentaCar - Todos os direitos reservados</p>
            <p>Contactos: email@autorentacar.com | +351 912 345 678</p>
        </div>
    </footer>
</body>
</html>
