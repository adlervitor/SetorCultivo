<?php
// Tayna Marioh
// Configurações do banco de dados
$servername = 'localhost';
$dbname = 'setorcultivo';
$username = 'root';
$password = '';

// Conectar ao banco de dados usando PDO
try {
    $conexao = new PDO("mysql:host=$servername", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("USE $dbname;");

    function inserirSustentabilidade($praticas_ambientais, $reducao_residuos, $energia_renovavel, $conexao){
        $sql = "INSERT INTO sustentabilidade (praticas_ambientais, reducao_residuos, energia_renovavel) VALUES (?, ?, ?)";    
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$praticas_ambientais, $reducao_residuos, $energia_renovavel]);     
    }

    inserirSustentabilidade('reciclagem', 80.25, 'compostagem', $conexao);

    echo "Dados inseridos com sucesso!";
} catch(PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>
