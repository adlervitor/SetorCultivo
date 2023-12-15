<?php
//Maria Fernanda C.

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Função para visualizar os dados da tabela sustentabilidade
    function visualizarSustentabilidade($conexao) {
        $sql = "SELECT * FROM sustentabilidade";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    // Chamando a função para visualizar os dados e exibindo-os
    $dadosSustentabilidade = visualizarSustentabilidade($conexao);

    if (count($dadosSustentabilidade) > 0) {
        echo "<h2>Registros da tabela sustentabilidade:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Log ID</th>
                    <th>Práticas Ambientais</th>
                    <th>Redução Resíduos</th>
                    <th>Energia Renovável</th>
                </tr>";

        foreach ($dadosSustentabilidade as $dado) {
            echo "<tr>";
            echo "<td>" . $dado['log_id'] . "</td>";
            echo "<td>" . $dado['praticas_ambientais'] . "</td>";
            echo "<td>" . $dado['reducao_residuos'] . "</td>";
            echo "<td>" . $dado['energia_renovavel'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Não foram encontrados registros na tabela sustentabilidade.";
    }

} catch(PDOException $e) {
    die("Erro ao visualizar os dados: " . $e->getMessage());
}
?>