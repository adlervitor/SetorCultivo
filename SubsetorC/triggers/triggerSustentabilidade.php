<?php
// Maria
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setorcultivo";

try {
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Comandos SQL dos triggers para sustentabilidade
    $triggersSustentabilidade = "
        CREATE TRIGGER tr_ins_sustentabilidade
        AFTER INSERT ON sustentabilidade
        FOR EACH ROW
        BEGIN
            INSERT INTO log_sustentabilidade (data_modificacao, alteracao, usuario)
            VALUES (NOW(), 'Inserção', CURRENT_USER());
        END;

        CREATE TRIGGER tr_upd_sustentabilidade
        AFTER UPDATE ON sustentabilidade
        FOR EACH ROW
        BEGIN
            INSERT INTO log_sustentabilidade (data_modificacao, alteracao, usuario)
            VALUES (NOW(), 'Atualização', CURRENT_USER());
        END;

        CREATE TRIGGER tr_del_sustentabilidade
        AFTER DELETE ON sustentabilidade
        FOR EACH ROW
        BEGIN
            INSERT INTO log_sustentabilidade (data_modificacao, alteracao, usuario)
            VALUES (NOW(), 'Exclusão', CURRENT_USER());
        END;
    ";

    // Executar comandos SQL dos triggers
    $conexao->exec($triggersSustentabilidade);

    echo "Triggers criados com sucesso!!";
} catch (PDOException $e) {
    echo "Erro na criação dos triggers: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conexao = null;
}
?>