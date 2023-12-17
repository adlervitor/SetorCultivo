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

    function inserirBiomassa($tipo_biomassa, $metodo_cultivo, $producao_estimada, $id_sustentabilidade, $conexao){
        $sql = "INSERT INTO outras_fontes_biomassa (tipo_biomassa, metodo_cultivo, producao_estimada, id_sustentabilidade) VALUES (?, ?, ?, ?)";    
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$tipo_biomassa, $metodo_cultivo, $producao_estimada, $id_sustentabilidade]);     
    }

    inserirBiomassa('Fossilica', 'Colheita', 90.75, 1, $conexao);

    echo "Dados inseridos com sucesso!";
} catch(PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>
