<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "setorcultivo";

try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para deletar registros da tabela outras_fontes_biomassa
    function deletarOutrasFontesBiomassa($conn, $id) {
        $sql = "DELETE FROM outras_fontes_biomassa WHERE id = $id";
        $conn->exec($sql);
        echo "Registro deletado da tabela outras_fontes_biomassa.<br>";
    }

    // Chamada da função para deletar registros
    deletarOutrasFontesBiomassa($conn, 1);
    deletarOutrasFontesBiomassa($conn, 2);
    deletarOutrasFontesBiomassa($conn, 3);

} catch (Exception $e) {
    echo "Erro na execução das operações: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conn = null;
}
?>