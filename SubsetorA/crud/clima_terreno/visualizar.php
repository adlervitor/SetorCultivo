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

    // Função para visualizar os dados da tabela clima_terreno
    function visualizarClimaTerreno($conexao) {
        $sql = "SELECT * FROM clima_terreno";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    // Chamando a função para visualizar os dados e exibindo-os
    $dadosClimaTerreno = visualizarClimaTerreno($conexao);

    if (count($dadosClimaTerreno) > 0) {
        echo "<h2>Climas encontrados:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Tipo de Solo</th>
                    <th>Região Climática</th>
                    <th>Nível Pluviométrico</th>
                </tr>";

        foreach ($dadosClimaTerreno as $dado) {
            echo "<tr>";
            echo "<td>" . $dado['id'] . "</td>";
            echo "<td>" . $dado['tipo_solo'] . "</td>";
            echo "<td>" . $dado['regiao_climatica'] . "</td>";
            echo "<td>" . $dado['nivel_pluviometrico'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Não encontramos nenhum clima.";
    }

} catch(PDOException $e) {
    die("Erro ao visualizar os dados: " . $e->getMessage());
}
?>
