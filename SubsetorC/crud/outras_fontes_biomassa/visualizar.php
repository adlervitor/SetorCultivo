<?php
// Maria Fernanda C.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("USE $dbname;");

    // Função para visualizar os dados da tabela clima_terreno
    function visualizarOutrasFontesBiomassa($conexao) {
        $sql = "SELECT * FROM outras_fontes_biomassa";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    // Chamando a função para visualizar os dados e exibindo-os
    $dadosOutrasFontesBiomassa = visualizarOutrasFontesBiomassa($conexao);

    if (count($dadosOutrasFontesBiomassa) > 0) {
        echo "<h2>Outras fontes de biomassa cadastradas:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Tipo Biomassa</th>
                    <th>Método Cultivo</th>
                    <th>Produção Estimada</th>
                </tr>";

        foreach ($dadosOutrasFontesBiomassa as $dado) {
            echo "<tr>";
            echo "<td>" . $dado['id'] . "</td>";
            echo "<td>" . $dado['tipo_biomassa'] . "</td>";
            echo "<td>" . $dado['metodo_cultivo'] . "</td>";
            echo "<td>" . $dado['producao_estimada'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Não foram encontrados registros de fontes de biomassa.";
    }

} catch(PDOException $e) {
    die("Erro ao visualizar os dados: " . $e->getMessage());
}
?>