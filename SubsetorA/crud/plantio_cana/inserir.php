<?php
// Adler Vitor Santiago B.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("USE $dbname;");

    // Inserir dados na tabela plantio_cana
    $sql_cana = "INSERT INTO plantio_cana (data_plantio, area_plantada, tipo_cana) VALUES 
    ('2021-08-20', 2000, 'Inglesa'),
    ('2023-03-10', 3500, 'Americana'),
    ('2022-12-15', 10000, 'Cerrado')";

    $conexao->exec($sql_cana);

    echo "Dados inseridos com sucesso!";
} catch(PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>