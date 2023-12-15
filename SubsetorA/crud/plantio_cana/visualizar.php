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

    // Função para visualizar os dados da tabela plantio_cana
    function visualizarPlantioCana($conexao) {
        $sql = "SELECT * FROM plantio_cana";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    // Chamando a função para visualizar os dados e exibindo-os
    $dadosPlantioCana = visualizarPlantioCana($conexao);

    if (count($dadosPlantioCana) > 0) {
        echo "<h2>Plantios encontrados:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Data de Plantio</th>
                    <th>Área Plantada</th>
                    <th>Tipo de Cana</th>
                </tr>";

        foreach ($dadosPlantioCana as $dado) {
            echo "<tr>";
            echo "<td>" . $dado['id'] . "</td>";
            echo "<td>" . $dado['data_plantio'] . "</td>";
            echo "<td>" . $dado['area_plantada'] . "</td>";
            echo "<td>" . $dado['tipo_cana'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Não foram encontrados nenhum plantio.";
    }

} catch(PDOException $e) {
    die("Erro ao realizar a operação: " . $e->getMessage());
}
?>
