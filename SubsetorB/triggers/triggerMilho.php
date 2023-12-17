<?php
// Melgacio
// Variáveis de conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Trigger AFTER INSERT na tabela producao_milho
    $queryTriggerMilho = "CREATE TRIGGER after_insert_producao_milho
    AFTER INSERT ON producao_milho 
    FOR EACH ROW 
    BEGIN
    INSERT INTO log_producao_milho (id, data_modificacao, alteracao, usuario)
        VALUES (NEW.id, CURRENT_TIMESTAMP, 'Inserção', 'NomeDoUsuario');
    END;";
    
    $conexao->exec($queryTriggerMilho);

    // Trigger AFTER UPDATE na tabela producao_milho
    $queryTriggerMilhoUpdate = "CREATE TRIGGER after_update_producao_milho
    AFTER UPDATE ON producao_milho 
    FOR EACH ROW 
    BEGIN
        INSERT INTO log_producao_milho (id, data_modificacao, alteracao, usuario)
        VALUES (NEW.id, CURRENT_TIMESTAMP, 'Atualização', 'NomeDoUsuario');
    END;";
    
    $conexao->exec($queryTriggerMilhoUpdate);

    // Trigger AFTER DELETE na tabela producao_milho
    $queryTriggerMilhoDelete = "CREATE TRIGGER after_delete_producao_milho
    AFTER DELETE ON producao_milho
    FOR EACH ROW 
    BEGIN
    INSERT INTO log_producao_milho (id, data_modificacao, alteracao, usuario)
        VALUES (OLD.id, CURRENT_TIMESTAMP, 'Exclusão', 'NomeDoUsuario');
    END;";
    
    $conexao->exec($queryTriggerMilhoDelete);

    echo "Triggers criados com sucesso para a tabela producao_milho!";
} catch(PDOException $e) {
    die("Erro ao criar trigger: " . $e->getMessage());
}
?>
