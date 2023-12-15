<?php
//Variáveis de conexão
$host = 'localhost'; 
$dbname = 'setorcultivo'; 
$user = 'root';
$password = ''; 

try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Trigger AFTER INSERT na tabela plantio_cana
    $queryTriggerPlantio = "
        CREATE TRIGGER after_insert_plantio_cana 
        AFTER INSERT ON plantio_cana 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_plantio_cana (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, CURRENT_TIMESTAMP, 'Inserção', 'NomeDoUsuario');
        END;
        CREATE TRIGGER after_update_plantio_cana 
        AFTER UPDATE ON plantio_cana 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_plantio_cana (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, CURRENT_TIMESTAMP, 'Atualização', 'NomeDoUsuario');
        END;
        CREATE TRIGGER after_delete_plantio_cana 
        AFTER DELETE ON plantio_cana 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_plantio_cana (id, data_modificacao, alteracao, usuario)
            VALUES (OLD.id, CURRENT_TIMESTAMP, 'Exclusão', 'NomeDoUsuario');
        END;
    ";
    
    $conexao->exec($queryTriggerPlantio);

    echo "Triggers criados com sucesso para a tabela plantio_cana!";
} catch(PDOException $e) {
    die("Erro ao criar trigger: " . $e->getMessage());
}
?>
