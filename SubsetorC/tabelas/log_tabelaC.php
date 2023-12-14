<?php
//Daniele, Marioh
// Configurações do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$host", $user, $password); 
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o banco de dados existe
    $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname';";
    $resultado = $conexao->query($query);

    // Se o banco de dados não existir, cria ele
    if ($resultado->rowCount() === 0) {
        $conexao->exec("CREATE DATABASE $dbname;");
    }

    // Conecta ao banco de dados especificado
    $conexao->exec("USE $dbname;");

    // Comandos SQL para criar tabelas
    $sql = "CREATE TABLE log_outras_fontes_biomassa (
        log_id INT AUTO_INCREMENT PRIMARY KEY,
        id INT,
        data_modificacao TIMESTAMP,
        alteracao VARCHAR(255) NOT NULL,
        usuario VARCHAR(255) NOT NULL
    );

    CREATE TABLE log_sustentabilidade (
        log_id INT AUTO_INCREMENT PRIMARY KEY,
        id INT,
        data_modificacao TIMESTAMP,
        alteracao VARCHAR(255) NOT NULL,
        usuario VARCHAR(255) NOT NULL
    );";

    $conexao->exec($sql);

    echo "Tabelas criadas com sucesso!";
} catch (Exception $e) {
    echo "Erro na criação das tabelas: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conexao = null;
}
?>