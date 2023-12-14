<?php
    // Melgacio
    // Definindo a conexão com o banco de dados
    $host = "localhost";
    $dbname = "setorcultivo";
    $user = "root";
    $password = "1234";

    try{
        $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->exec("USE $dbname;");
        
        // Dados para inserir as tabelas

        $sql_milho = "INSERT INTO producao_milho (data_plantio, colheita_prevista, tipo_milho) VALUES 
        ('2021-08-20', 2000, 'Pipoca'),
        ('2023-03-10', 3500, 'Canjica'),
        ('2022-12-15', 10000, 'Vermelho')";
    
        $conexao->exec($sql_milho);
    
        // Mensagem para confirmar a criação da tabela
        echo "Dados inseridos com sucesso!\n";

        }catch (PDOException $e) {
            die("Erro ao inserir dados as tabelas: " . $e->getMessage());
    }

?>