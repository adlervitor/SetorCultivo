<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para deletar registros da tabela sustentabilidade
    function deletarSustentabilidade($conn, $id) {
        $sql = "DELETE FROM sustentabilidade WHERE id = $id";
        $conn->exec($sql);
        echo "Registro deletado da tabela sustentabilidade.<br>";
    }

    // Chamada da função para deletar registros
    deletarSustentabilidade($conn, 1);

} catch (Exception $e) {
    echo "Erro na execução das operações: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conn = null;
}
?>