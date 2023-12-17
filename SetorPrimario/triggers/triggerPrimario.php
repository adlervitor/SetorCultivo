<?php
//Variáveis de conexão
$host = 'localhost'; 
$dbname = 'setorcultivo'; 
$user = 'root';
$password = ''; 

try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $queryTriggerPrincipal = "
        CREATE TRIGGER after_insert_log_clima_terreno 
        AFTER INSERT ON log_clima_terreno 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_cultivo_materia_prima (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, NEW.data_modificacao, NEW.alteracao, NEW.usuario);
        END;
        CREATE TRIGGER after_insert_log_plantio_cana 
        AFTER INSERT ON log_plantio_cana
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_cultivo_materia_prima (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, NEW.data_modificacao, NEW.alteracao, NEW.usuario);
        END;
        CREATE TRIGGER after_insert_log_uso_agroquimicos 
        AFTER INSERT ON log_uso_agroquimicos 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_cultivo_materia_prima (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, NEW.data_modificacao, NEW.alteracao, NEW.usuario);
        END;
        CREATE TRIGGER after_insert_log_producao_milho 
        AFTER INSERT ON log_producao_milho 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_cultivo_materia_prima (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, NEW.data_modificacao, NEW.alteracao, NEW.usuario);
        END;
        CREATE TRIGGER after_insert_log_outras_fontes_biomassa 
        AFTER INSERT ON log_outras_fontes_biomassa 
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_cultivo_materia_prima (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, NEW.data_modificacao, NEW.alteracao, NEW.usuario);
        END;
        CREATE TRIGGER after_insert_log_sustentabilidade 
        AFTER INSERT ON log_sustentabilidade
        FOR EACH ROW 
        BEGIN
            INSERT INTO log_cultivo_materia_prima (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, NEW.data_modificacao, NEW.alteracao, NEW.usuario);
        END;
    ";
    
    $conexao->exec($queryTriggerPrincipal);

    echo "Triggers criados com sucesso!";
} catch(PDOException $e) {
    die("Erro ao criar trigger: " . $e->getMessage());
}
?>
