<?php
    // Configurações do banco de dados
    $host = 'localhost'; // Servidor do banco de dados
    $usuario = 'root'; // Usuário do banco
    $senha = ''; // Senha do banco (preencha se necessário)
    $banco = 'auto_rentacar'; // Nome do banco de dados

    // Criar conexão
    $conn = mysqli_connect($host, $usuario, $senha, $banco);

    // Verificar conexão
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }
?>
