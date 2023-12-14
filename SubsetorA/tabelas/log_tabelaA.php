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
    $queryTabelas = "CREATE TABLE IF NOT EXISTS log_plantio_cana (
        log_id INT AUTO_INCREMENT PRIMARY KEY,
        id INT NOT NULL,
        data_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        alteracao VARCHAR(255) NOT NULL,
        usuario VARCHAR(255) NOT NULL
    );
    CREATE TABLE IF NOT EXISTS log_clima_terreno (
        log_id INT AUTO_INCREMENT PRIMARY KEY,
        id INT NOT NULL,
        data_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        alteracao VARCHAR(255) NOT NULL,
        usuario VARCHAR(255) NOT NULL
    );";

    $conexao->exec($queryTabelas);

    echo "Tabelas criadas com sucesso!";
} catch(PDOException $e) {
    die("Erro ao criar tabelas: " . $e->getMessage());
}
?>