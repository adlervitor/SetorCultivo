<?php
// Vitor Botelho
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Função para deletar Agroquimicos
    function deletarusoAgroquimicos($conn, $id) {
        $sql = "DELETE FROM uso_agroquimicos WHERE id = $id";
        $conn->exec($sql);
        echo "Agroquimico deletado da tabela.<br>";
    }

    //chamada de função para deletar registros
    deletarusoAgroquimicos($conexao, 1);

    // Mensagem para confirmar a exclusão dos itens
} catch (Exception $e) {
    echo "Erro na execução das operações: " . $e->getMessage();
} finally {
    // Fecha a conexão
$conexao = null;
}
?>