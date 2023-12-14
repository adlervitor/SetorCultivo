<?php
// Vitor botelho
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("USE $dbname;");

    // Inserir dados na tabela plantio_cana
    $sql_agroquimicos = "INSERT INTO uso_agroquimicos (tipo_produto, quantidade_utilizada, impacto_ambiental) VALUES 
    ('herbicidas',15.2, 'moderado'),
    ('fungicida', 8.7, 'baixo'),
    ('inseticida',12.5, 'Alto')";

    $conexao->exec($sql_agroquimicos);

    echo "Dados inseridos com sucesso!";
} catch(PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>