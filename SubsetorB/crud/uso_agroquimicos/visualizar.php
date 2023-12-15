<?php

// Vitor Botelho
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("USE $dbname;");

    // Função para visualizar os dados da tabela uso_agroquimicos
    function visualizarAgroquimicos($conexao) {
        $sql = "SELECT * FROM uso_agroquimicos";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    // Chamando a função para visualizar os dados e exibindo-os
    $dadosMilho = visualizarAgroquimicos($conexao);

    if (count($dadosMilho) > 0) {
        echo "<h2>Uso de Agroquimícos:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Tipo do Produto</th>
                    <th>Quantidade Utilizada</th>
                    <th>Impacto Ambiental</th>
                </tr>";

        foreach ($dadosMilho as $dado) {
            echo "<tr>";
            echo "<td>" . $dado['id'] . "</td>";
            echo "<td>" . $dado['tipo_produto'] . "</td>";
            echo "<td>" . $dado['quantidade_utilizada'] . "</td>";
            echo "<td>" . $dado['impacto_ambiental'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Não encontramos nenhum uso de agroquímicos.";
    }

} catch(PDOException $e) {
    die("Erro ao visualizar os dados: " . $e->getMessage());
}
?>
