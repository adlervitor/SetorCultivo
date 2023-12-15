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

    function inserirClimaTerreno($tipo_solo, $regiao_climatica, $nivel_pluviometrico, $conexao){
        $sql = "INSERT INTO clima_terreno (tipo_solo, regiao_climatica, nivel_pluviometrico) VALUES (?, ?, ?)";    
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$tipo_solo, $regiao_climatica, $nivel_pluviometrico]);     
    }
    
    echo inserirClimaTerreno('Árido', 'Cerrado', 300, $conexao);

    echo "Dados inseridos com sucesso!";
} catch(PDOException $e) {
    die("Erro ao inserir os dados: " . $e->getMessage());
}
?>