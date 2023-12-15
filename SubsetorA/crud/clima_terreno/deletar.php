<?php
//Adler
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para deletar um registro de clima
    function deletarClimaTerreno($conn, $id) {
        $sql = "DELETE FROM clima_terreno WHERE id = $id";
        $conn->exec($sql);
        echo "Clima deletado da tabela.";
    }

    // Chamada da função para deletar registros
    deletarClimaTerreno($conn, 1);

} catch (Exception $e) {
    echo "Erro na execução das operações: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conn = null;
}
?>