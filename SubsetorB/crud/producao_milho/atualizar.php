<?php
    // Melgacio
    // Definindo a conexão com o banco de dados
    $host = "localhost";
    $dbname = "setorcultivo";
    $user = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Função para atualizar dados na tabela
        function atualizarDadosMilho($id, $data_plantio, $colheita_prevista, $tipo_milho, $conn) {
        $sql = "UPDATE producao_milho SET data_plantio=?, colheita_prevista=?, tipo_milho=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$data_plantio, $colheita_prevista, $tipo_milho, $id]);

        return "Produção de milho atualizada com sucesso!";
    }
    echo atualizarDadosMilho(4, '2023-12-02', 10000 , "Milho de Pipoca", $conn) . "<br>";
    echo atualizarDadosMilho(5, '2022-11-01', 25000, "Milho de Canjica", $conn) . "<br>";
    echo atualizarDadosMilho(6, '2020-07-27', 5000, "Milho Verde", $conn) . "<br>";
    
    $conn = null;

    }catch(PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }
?>