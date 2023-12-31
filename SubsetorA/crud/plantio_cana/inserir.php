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

    function inserirPlantioCana($data_plantio, $area_plantada, $tipo_cana, $id_clima_terreno, $conexao){
        $sql = "INSERT INTO plantio_cana (data_plantio, area_plantada, tipo_cana, id_clima_terreno) VALUES (?, ?, ?, ?)";    
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$data_plantio, $area_plantada, $tipo_cana, $id_clima_terreno]);     
    }

    echo inserirPlantioCana('2021-08-20', 2000, 'Inglesa', 1, $conexao);

    echo "Dados inseridos com sucesso!";
} catch(PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>