<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    // Estabelece uma conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para atualizar registros na tabela sustentabilidade
    function atualizarSustentabilidade($conn, $id, $praticasAmbientais, $reducaoResiduos, $energiaRenovavel) {

        // Query SQL para atualizar registros na tabela sustentabilidade
        $sql = "UPDATE sustentabilidade  
                SET praticas_ambientais = :praticas_ambientais, reducao_residuos = :reducao_residuos, energia_renovavel = :energia_renovavel 
                WHERE id = :id";

        // Prepara a declaração SQL para execução
        $stmt = $conn->prepare($sql);

        // Vincula os parâmetros da consulta aos valores fornecidos
        $stmt->bindParam(':praticas_ambientais', $praticasAmbientais);
        $stmt->bindParam(':reducao_residuos', $reducaoResiduos);
        $stmt->bindParam(':energia_renovavel', $energiaRenovavel);
        $stmt->bindParam(':id', $id);

        // Executa a consulta preparada
        $stmt->execute();
    }

    // Uso da função para atualizar registros em sustentabilidade
    atualizarSustentabilidade($conn, 1, 'Novas Práticas', 'Menos Resíduos', 'Energia Solar');
    atualizarSustentabilidade($conn, 2, 'Outras Práticas', 'Reciclagem', 'Energia Eólica');
    atualizarSustentabilidade($conn, 3, 'Práticas Atualizadas', 'Redução de Resíduos', 'Hidrelétrica');

    // Mensagem indicando que os registros foram atualizados com sucesso
    echo "Registros atualizados com sucesso!";
} catch (Exception $e) {
    // Mensagem de erro caso ocorra uma exceção durante o processo
    echo "Erro na atualização: " . $e->getMessage();
} finally {
    // Fecha a conexão com o banco de dados, independentemente de qualquer exceção
    $conn = null;
}
?>
