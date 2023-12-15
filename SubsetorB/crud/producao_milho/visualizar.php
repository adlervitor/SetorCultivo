<?php

// Melgacio
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("USE $dbname;");

    // Função para visualizar os dados da tabela producao_milho
    function visualizarMilho($conexao) {
        $sql = "SELECT * FROM producao_milho";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    // Chamando a função para visualizar os dados e exibindo-os
    $dadosMilho = visualizarMilho($conexao);

    if (count($dadosMilho) > 0) {
        echo "<h2>Produção de Milho:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Data do Plantio</th>
                    <th>Colheita Prevista</th>
                    <th>Tipo do Milho</th>
                </tr>";

        foreach ($dadosMilho as $dado) {
            echo "<tr>";
            echo "<td>" . $dado['id'] . "</td>";
            echo "<td>" . $dado['data_plantio'] . "</td>";
            echo "<td>" . $dado['colheita_prevista'] . "</td>";
            echo "<td>" . $dado['tipo_milho'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Não encontramos nenhuma produção de milho.";
    }

} catch(PDOException $e) {
    die("Erro ao visualizar os dados: " . $e->getMessage());
}
?>
