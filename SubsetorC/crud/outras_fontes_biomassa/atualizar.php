<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    // Estabelece uma conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para atualizar registros na tabela outras_fontes_biomassa
    function atualizarOutrasFontesBiomassa($conn, $id, $tipoBiomassa, $metodoCultivo, $producaoEstimada, $id_sustentabilidade) {
        // Query SQL para atualizar registros na tabela outras_fontes_biomassa
        $sql = "UPDATE outras_fontes_biomassa 
                SET tipo_biomassa = :tipo, metodo_cultivo = :metodo, producao_estimada = :producao, id_sustentabilidade = :sustentabilidade
                WHERE id = :id";

        // Prepara a declaração SQL para execução
        $stmt = $conn->prepare($sql);

        // Vincula os parâmetros da consulta aos valores fornecidos
        $stmt->bindParam(':tipo', $tipoBiomassa);
        $stmt->bindParam(':metodo', $metodoCultivo);
        $stmt->bindParam(':producao', $producaoEstimada);
        $stmt->bindParam(':sustentabilidade', $id_sustentabilidade);
        $stmt->bindParam(':id', $id);
        
        // Executa a consulta preparada
        $stmt->execute();
    }

    // Uso da função para atualizar registros em outras_fontes_biomassa
    atualizarOutrasFontesBiomassa($conn, 1, 'Novo Tipo', 'Novo Método', 150.50, 1);

    echo "Registros atualizados com sucesso!";
} catch (Exception $e) {
    // Mensagem de erro caso ocorra uma exceção durante o processo
    echo "Erro na atualização: " . $e->getMessage();
} finally {
    $conn = null;
}
?>
