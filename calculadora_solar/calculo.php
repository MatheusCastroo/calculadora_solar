<?php
require 'conexao.php'; // Importa a conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegando os valores do formulário
    $potencia = trim($_POST['potencia'] ?? '');
    $modelo_bateria = trim($_POST['modelo_bateria'] ?? '');
    $desc_bateria = trim($_POST['descarregar_bateria'] ?? '');
    $tensao_bateria = trim($_POST['tensao_bateria'] ?? '');

    // Mapeando os valores do select para números inteiros (porcentagem)
    $mapa_descarga = [
        "bat30" => 30,
        "bat40" => 40,
        "bat50" => 50,
        "bat60" => 60,
        "bat70" => 70,
        "bat80" => 80
    ];
    //Mapeando os valores do select para números inteiros (porcentagem)
    $mapa_tensao = [
        "tensao_bateria_12" => 12,
        "tensao_bateria_24" => 24,
        "tensao_bateria_48" => 48
    ];

    // Validando a potência
    if (!is_numeric($potencia) || $potencia <= 0) {
        die("Erro: Informe uma potência válida!");
    }

    // Validando o modelo de bateria
    if ($modelo_bateria == "null" || empty($modelo_bateria)) {
        die("Erro: Selecione um modelo de bateria!");
    }

    // Validando a descarga da bateria
    if (!isset($mapa_descarga[$desc_bateria])) {
        die("Erro: Selecione um valor válido para a descarga da bateria!");
    }
    // Validando a tensao bateria
    if (!isset($mapa_tensao[$tensao_bateria])) {
        die("Erro: Selecione um valor válido para a tensao da bateria!");
    }

    $porcentagem_descarga = $mapa_descarga[$desc_bateria] / 100; // Converte para decimal (ex: 30% -> 0.3)
    $tensao_bateria_vdc = $mapa_tensao[$tensao_bateria];

    // Consulta ao banco para buscar a capacidade da bateria pelo modelo
    $sql = "SELECT capacidade_ah FROM bateriasolar WHERE modelo = :modelo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':modelo' => $modelo_bateria]);

    // Verifica se encontrou a bateria
    $bateria = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($bateria) {
        $capacidade_ah = intval($bateria['capacidade_ah']); // Converte para inteiro

        echo "Número do AH da bateria selecionada: " . $capacidade_ah . "<br>";
        echo "Bateria será descarregada até: " . ($porcentagem_descarga * 100) . "%<br>";
        echo "Tensão da bateria é: " . ($tensao_bateria_vdc) . "<br>";
    } else {
        echo "Erro: Modelo de bateria não encontrado!";
    }
}
