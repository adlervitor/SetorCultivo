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
    $sql = "
    CREATE TABLE sustentabilidade (
        id INT AUTO_INCREMENT PRIMARY KEY,
        praticas_ambientais VARCHAR(255),
        reducao_residuos VARCHAR(255) NOT NULL,
        energia_renovavel VARCHAR(255) NOT NULL
    );    
    CREATE TABLE outras_fontes_biomassa (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipo_biomassa VARCHAR(255) NOT NULL,
        metodo_cultivo VARCHAR(255) NOT NULL,
        producao_estimada DECIMAL(10,2) NOT NULL,
        id_sustentabilidade INT,
        FOREIGN KEY (id_sustentabilidade) REFERENCES sustentabilidade(id) ON DELETE SET NULL
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
