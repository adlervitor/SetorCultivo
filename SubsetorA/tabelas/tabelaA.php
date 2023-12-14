<?php
//Adler
//Variáveis de conexão
$host = 'localhost'; 
$dbname = 'setorcultivo'; 
$user = 'root';
$password = '1234'; 

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
    $queryTabelas = "CREATE TABLE IF NOT EXISTS plantio_cana (
        id INT AUTO_INCREMENT PRIMARY KEY,
        data_plantio DATE NOT NULL,
        area_plantada INT NOT NULL,
        tipo_cana VARCHAR(255) NOT NULL
    );
    CREATE TABLE IF NOT EXISTS clima_terreno (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipo_solo VARCHAR(255) NOT NULL,
        regiao_climatica VARCHAR(255) NOT NULL,
        nivel_pluviometrico INT NOT NULL
    );";

    $conexao->exec($queryTabelas);

    echo "Tabelas criadas com sucesso!";
} catch(PDOException $e) {
    die("Erro ao criar tabelas: " . $e->getMessage());
}
?>