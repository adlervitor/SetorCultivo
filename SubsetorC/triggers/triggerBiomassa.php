<?php
// Maria
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Comandos SQL dos triggers para outras_fontes_biomassa
    $triggersOutrasFontesBiomassa = "
        CREATE TRIGGER tr_ins_outras_fontes_biomassa
        AFTER INSERT ON outras_fontes_biomassa
        FOR EACH ROW
        BEGIN
            INSERT INTO log_outras_fontes_biomassa (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, NOW(), 'Inserção', 'root@localhost');
        END;

        CREATE TRIGGER tr_upd_outras_fontes_biomassa
        AFTER UPDATE ON outras_fontes_biomassa
        FOR EACH ROW
        BEGIN
            INSERT INTO log_outras_fontes_biomassa (id, data_modificacao, alteracao, usuario)
            VALUES (NEW.id, NOW(), 'Atualização', 'root@localhost');
        END;

        CREATE TRIGGER tr_del_outras_fontes_biomassa
        AFTER DELETE ON outras_fontes_biomassa
        FOR EACH ROW
        BEGIN
            INSERT INTO log_outras_fontes_biomassa (id, data_modificacao, alteracao, usuario)
            VALUES (OLD.id, NOW(), 'Exclusão', 'root@localhost');
        END;
    ";

    // Executar comandos SQL dos triggers
    $conexao->exec($triggersOutrasFontesBiomassa);

    echo "Triggers criados com sucesso!!";
} catch (PDOException $e) {
    echo "Erro na criação dos triggers: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conexao = null;
}
?>