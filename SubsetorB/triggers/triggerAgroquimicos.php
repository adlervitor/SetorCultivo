<?php
// Vitor Botelho
// Variáveis de conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); 
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Trigger AFTER INSERT na tabela uso_agroquimicos
    $queryTriggerAgroquimicos = "CREATE TRIGGER after_insert_uso_agroquimicos
    AFTER INSERT ON uso_agroquimicos 
    FOR EACH ROW 
    BEGIN
        INSERT INTO log_uso_agroquimicos (id, data_modificacao, alteracao, usuario)
        VALUES (NEW.id, CURRENT_TIMESTAMP, 'Inserção', 'NomeDoUsuario');
    END;";
    
    $conexao->exec($queryTriggerAgroquimicos);

    // Trigger AFTER UPDATE na tabela uso_agroquimicos
    $queryTriggerAgroquimicosUpdate = "CREATE TRIGGER after_update_uso_agroquimicos
    AFTER UPDATE ON uso_agroquimicos 
    FOR EACH ROW 
    BEGIN
        INSERT INTO log_uso_agroquimicos (id, data_modificacao, alteracao, usuario)
        VALUES (NEW.id, CURRENT_TIMESTAMP, 'Atualização', 'NomeDoUsuario');
    END;";
    
    $conexao->exec($queryTriggerAgroquimicosUpdate);

    // Trigger AFTER DELETE na tabela uso_agroquimicos
    $queryTriggerAgroquimicosDelete = "CREATE TRIGGER after_delete_uso_agroquimicos
    AFTER DELETE ON uso_agroquimicos
    FOR EACH ROW 
    BEGIN
        INSERT INTO log_uso_agroquimicos (id, data_modificacao, alteracao, usuario)
        VALUES (OLD.id, CURRENT_TIMESTAMP, 'Exclusão', 'NomeDoUsuario');
    END;";
    
    $conexao->exec($queryTriggerAgroquimicosDelete);

    echo "Triggers criados com sucesso para a tabela uso_agroquimicos!";
} catch(PDOException $e) {
    die("Erro ao criar trigger: " . $e->getMessage());
}
?>
