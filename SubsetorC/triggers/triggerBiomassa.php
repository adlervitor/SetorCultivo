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
            INSERT INTO log_outras_fontes_biomassa (data_modificacao, alteracao, usuario)
            VALUES (NOW(), 'Inserção', CURRENT_USER());
        END;

        CREATE TRIGGER tr_upd_outras_fontes_biomassa
        AFTER UPDATE ON outras_fontes_biomassa
        FOR EACH ROW
        BEGIN
            INSERT INTO log_outras_fontes_biomassa (data_modificacao, alteracao, usuario)
            VALUES (NOW(), 'Atualização', CURRENT_USER());
        END;

        CREATE TRIGGER tr_del_outras_fontes_biomassa
        AFTER DELETE ON outras_fontes_biomassa
        FOR EACH ROW
        BEGIN
            INSERT INTO log_outras_fontes_biomassa (data_modificacao, alteracao, usuario)
            VALUES (NOW(), 'Exclusão', CURRENT_USER());
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