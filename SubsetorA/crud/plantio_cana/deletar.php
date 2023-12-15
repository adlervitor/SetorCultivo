<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "setorcultivo";

try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para deletar um registro de plantio de cana
    function deletarPlantioCana($conn, $id) {
        $sql = "DELETE FROM plantio_cana WHERE id = $id";
        $conn->exec($sql);
        echo "Plantio deletado da tabela.";
    }

    // Chamada da função para deletar registros
    deletarPlantioCana($conn, 1);

} catch (Exception $e) {
    echo "Erro na execução das operações: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conn = null;
}
?>
