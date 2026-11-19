<?php
include "conecta.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['cpf'], $_POST['senha'])) {
    http_response_code(400);
    exit("Dados de login inválidos.");
}

$cpf = trim($_POST['cpf']);
$senha = $_POST['senha'];

$sql = "SELECT 1 FROM aluno WHERE cpf = :cpf AND senha = :senha LIMIT 1";

try {
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':cpf' => $cpf,
        ':senha' => $senha
    ]);

    if ($stmt->fetchColumn() !== false) {
        echo "Login bem-sucedido!";
    } else {
        echo "CPF ou senha incorretos.";
    }
} catch (PDOException $e) {
    // Registre o erro em um log no servidor, sem exibir detalhes ao usuário.
    http_response_code(500);
    echo "Não foi possível realizar o login.";
}
?>
