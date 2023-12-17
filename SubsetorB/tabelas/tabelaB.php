<?php
    //Vitor Botelho e Melgacio
    // Definindo a conexão com o banco de dados
    $host = "localhost";
    $dbname = "setorcultivo";
    $user = "root";
    $password = "";

    try{
        $conexao = new PDO("mysql:host=$host", $user, $password); 
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se o banco de dados existe
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname';";
        $resultado = $conexao->query($query);

        // Se o banco de dados não existir, cria ele
        if ($resultado->rowCount() === 0) {
            $conexao->exec("CREATE DATABASE $dbname;");
        }

        // Conecta ao banco de dados especificado
        $conexao->exec("USE $dbname;");

        // Criando as tabelas
        $queryTabelas = "
        CREATE TABLE IF NOT EXISTS uso_agroquimicos (
            id INT AUTO_INCREMENT PRIMARY KEY ,
            tipo_produto VARCHAR(255) NOT NULL,
            quantidade_utilizada DECIMAL (10,2) NOT NULL,
            impacto_ambiental VARCHAR(255) NOT NULL
        );
        CREATE TABLE IF NOT EXISTS producao_milho (
            id INT AUTO_INCREMENT PRIMARY KEY,
            data_plantio DATE NOT NULL,
            colheita_prevista INT NOT NULL,
            tipo_milho VARCHAR(100) NOT NULL,
            id_uso_agroquimicos INT,
            FOREIGN KEY (id_uso_agroquimicos) REFERENCES uso_agroquimicos(id) ON DELETE SET NULL
        );
        ";

    $conexao->exec($queryTabelas);

        // Mensagem para confirmar a criação da tabela
    echo "Tabelas criadas com sucesso!\n";

    }catch (PDOException $e) {
        die("Erro ao criar as tabelas: " . $e->getMessage());
}
?>