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

    // Dados para inserir nas tabelas

    function inserirAgroquimicos($tipo_produto, $quantidade_utilizada, $impacto_ambiental, $conexao){
        $sql = "INSERT INTO uso_agroquimicos (tipo_produto, quantidade_utilizada, impacto_ambiental) VALUES (?, ?, ?)";    
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$tipo_produto, $quantidade_utilizada, $impacto_ambiental]);     
    }

    echo inserirAgroquimicos('Inseticidas', 50, 'Contaminação da água e solo', $conexao);

    echo "Dados inseridos com sucesso!";
} catch(PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>