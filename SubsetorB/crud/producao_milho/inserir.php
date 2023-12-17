<?php
    // Melgacio
    // Definindo a conexão com o banco de dados
    $host = "localhost";
    $dbname = "setorcultivo";
    $user = "root";
    $password = "";

    try{
        $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexao->exec("USE $dbname;");
        
        // Dados para inserir as tabelas

        function inserirMilho($data_plantio, $colheita_prevista, $tipo_milho, $id_uso_agroquimicos, $conexao){
            $sql = "INSERT INTO producao_milho (data_plantio, colheita_prevista, tipo_milho, id_uso_agroquimicos) VALUES (?, ?, ?, ?)";    
            $stmt = $conexao->prepare($sql);
            $stmt->execute([$data_plantio, $colheita_prevista, $tipo_milho, $id_uso_agroquimicos]);     
        }
    
        echo inserirMilho('2020-12-12', 20000, 'Milho Verde', 1, $conexao);
    
        // Mensagem para confirmar a criação da tabela
        echo "Dados inseridos com sucesso!\n";

        }catch (PDOException $e) {
            die("Erro ao inserir dados as tabelas: " . $e->getMessage());
    }

?>