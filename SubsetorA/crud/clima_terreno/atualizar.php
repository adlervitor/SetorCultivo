<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para atualizar dados na tabela 'clima_terreno'
    function atualizarClima($id, $tipo_solo, $regiao_climatica, $nivel_pluviometrico, $conn) {
        $sql = "UPDATE clima_terreno SET tipo_solo=?, regiao_climatica=?, nivel_pluviometrico=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$tipo_solo, $regiao_climatica, $nivel_pluviometrico, $id]);

        return "Registro de clima atualizado com sucesso!";
    }

    echo atualizarClima(1, 'Branco', 'Minas', 80, $conn) . "<br>";

    $conn = null;

} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
