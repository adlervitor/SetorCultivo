<?php
//Vitor botelho
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para atualizar dados na tabela 'uso_agroquimicos'
    function atualizarAgroquimicos($id, $tipo_produto, $quantidade_utilizada, $impacto_ambiental, $conn) {
        $sql = "UPDATE uso_agroquimicos SET tipo_produto=?, quantidade_utilizada=?, impacto_ambiental=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$tipo_produto, $quantidade_utilizada, $impacto_ambiental, $id]);

        return "Registro de clima atualizado com sucesso!";
    }

    echo atualizarAgroquimicos(1, 'raticidas', 5.2, 'Toxicidade', $conn) . "<br>";

    $conn = null;

} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
