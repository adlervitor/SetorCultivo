<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para atualizar dados na tabela 'plantio_cana'
    function atualizarPlantioCana($id, $data_plantio, $area_plantada, $tipo_cana, $id_clima_terreno, $conn) {
        $sql = "UPDATE plantio_cana SET data_plantio=?, area_plantada=?, tipo_cana=?, id_clima_terreno=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$data_plantio, $area_plantada, $tipo_cana, $id_clima_terreno, $id]);

        return "Registro de plantio de cana atualizado com sucesso!";
    }

    // Chamada da função para atualizar
    echo atualizarPlantioCana(1, '2020-12-24', 10000, 'Cerrado', 1, $conn) . "<br>";

    $conn = null;

} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
