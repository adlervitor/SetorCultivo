<?php
//Variáveis de conexão
$host = 'localhost'; 
$dbname = 'setorcultivo'; 
$user = 'root';
$password = ''; 

try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Trigger AFTER INSERT na tabela clima_terreno
    $queryTriggerClima = "
        CREATE TRIGGER after_insert_clima_terreno 
        AFTER INSERT ON clima_terreno 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_clima_terreno (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, CURRENT_TIMESTAMP, 'Inserção', 'NomeDoUsuario');
        END;
        CREATE TRIGGER after_update_clima_terreno 
        AFTER UPDATE ON clima_terreno 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_clima_terreno (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, CURRENT_TIMESTAMP, 'Atualização', 'NomeDoUsuario');
        END;
        CREATE TRIGGER after_delete_clima_terreno 
        AFTER DELETE ON clima_terreno 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_clima_terreno (id, data_modificacao, alteracao, usuario)
            VALUES (OLD.id, CURRENT_TIMESTAMP, 'Exclusão', 'NomeDoUsuario');
        END;
    ";
    
    $conexao->exec($queryTriggerClima);

    echo "Triggers criados com sucesso para a tabela clima_terreno!";
} catch(PDOException $e) {
    die("Erro ao criar trigger: " . $e->getMessage());
}
?>
