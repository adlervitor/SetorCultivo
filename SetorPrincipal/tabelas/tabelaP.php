<?php
//Adler
//Variáveis de conexão
$host = 'localhost'; 
$dbname = 'setorcultivo'; 
$user = 'root';
$password = ''; 

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
    
    //Criando as tabelas
    $queryTabelas = "CREATE TABLE IF NOT EXISTS cultivo_materia_prima (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipo_cultivo VARCHAR(255) NOT NULL,
        area_total_cultivada INT NOT NULL,
        tecnologias_utilizadas VARCHAR(255) NOT NULL
    );";

    $conexao->exec($queryTabelas);

    echo "Tabelas criadas com sucesso!";
} catch(PDOException $e) {
    die("Erro ao criar tabelas: " . $e->getMessage());
}
?>