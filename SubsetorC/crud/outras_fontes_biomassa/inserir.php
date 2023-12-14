<?php
// Configurações do banco de dados
$servername = 'localhost';
$dbname = 'setorcultivo';
$username = 'root';
$password = '';

// Conectar ao banco de dados usando PDO
try {
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_biomassa = "INSERT INTO outras_fontes_biomassa (tipo_biomassa, metodo_cultivo, producao_estimada) VALUES
    ('Fossilica', 'Colheita', 90.75),
    ('Fossilica', 'Colheita', 90.75),
    ('Fossilica', 'Colheita', 90.75)";

    $conexao->exec($sql_biomassa);

    echo "Dados inseridos com sucesso!";
} catch (PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>
