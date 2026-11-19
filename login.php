<?php
//Incluindo o arquivo o arquivo de conexão nesse arquivo
include "conecta.php";

// Recebendo os dados do formulário
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];


<?php
// Consulta SQL preparada (segura contra SQL Injection)
$sql = "SELECT * FROM aluno WHERE cpf = :cpf AND senha = :senha";

try {
    // Preparando a consulta
    $stmt = $conexao->prepare($sql);

    // Executando a consulta com parâmetros
    $stmt->execute([
        ':cpf' => $cpf,
        ':senha' => $senha
    ]);

    // Verificando se existe um registro
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($linha) {
        echo "Login bem-sucedido!";
    } else {
        echo "CPF ou senha incorretos.";
    }

} catch (PDOException $e) {
    // Não exibir detalhes internos do banco ao usuário
    error_log("Erro ao executar consulta: " . $e->getMessage());
    echo "Ocorreu um erro ao realizar o login.";
}
?>

