<?php
require 'conexao.php'; // Importa a conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegando os valores do formulário
    $potencia = trim($_POST['potencia'] ?? '');
    $modelo_bateria = trim($_POST['modelo_bateria'] ?? '');

    // Validando a potência
    if (!($potencia) || $potencia <= 0) {
        die("Erro: Informe uma potência válida!");
    }

    // Validando o modelo de bateria
    if ($modelo_bateria == "null" || empty($modelo_bateria)) {
        die("Erro: Selecione um modelo de bateria!");
    }

    // Consulta ao banco para buscar a capacidade da bateria pelo modelo
    $sql = "SELECT capacidade_ah FROM bateriasolar WHERE modelo = :modelo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':modelo' => $modelo_bateria]);
    // Verifica se encontrou a bateria
    if ($capacidade_ah = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Número do AH da bateria selecionada: " . $capacidade_ah['capacidade_ah'];
    } else {
        echo "Erro: Modelo de bateria não encontrado!";
    }

}
