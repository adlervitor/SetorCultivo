<?php
// Adler Vitor Santiago B.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    // Criando a conexão
    $conexao = new PDO("mysql:host=$servername", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("USE $dbname;");
    // Especificando o clima a ser excluído pelo id
    $id_clima_excluir = 1;

    // Deletando o id especificado
    $sql_clima = "DELETE FROM clima_terreno WHERE id = $id_clima_excluir";

    $conexao->exec($sql_clima);

    echo "Clima excluído com sucesso!";
} catch(PDOException $e) {
    die("Erro ao excluir os dados: " . $e->getMessage());
}
?>