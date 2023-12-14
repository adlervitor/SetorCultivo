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

    // Inserir dados na tabela clima_terreno
    $sql_clima = "INSERT INTO clima_terreno (tipo_solo, regiao_climatica, nivel_pluviometrico) VALUES 
    ('Árido', 'Cerrado', 300),
    ('Vermelho', 'Floresta', 100),
    ('Molhado', 'Pancadas de Chuva', 150)";

    $conexao->exec($sql_clima);

    echo "Dados inseridos com sucesso!";
} catch(PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>