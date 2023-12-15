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
        
        // Função para excluir itens da tabela
        function deletarMilho($conn, $id) {
            $sql = "DELETE FROM producao_milho WHERE id = $id";
            $conn->exec($sql);
            echo "Dados excluídos da tabela. <br>";
        }
    
        // Chamada da função para deletar registros
        deletarMilho($conexao, 1);

        // Mensagem para confirmar a exclusão dos itens
        } catch (Exception $e) {
            echo "Erro na execução das operações: " . $e->getMessage();
        } finally {
            // Fecha a conexão
        $conexao = null;
    }
    
?>