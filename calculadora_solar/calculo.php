
<?php
require 'conexao.php'; // Importa a conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $potencia = trim($_POST['potencia'] ?? '');
    $modelo_bateria = trim($_POST['modelo_bateria'] ?? '');
    $desc_bateria = trim($_POST['descarregar_bateria'] ?? '');
    $tensao_bateria = trim($_POST['tensao_bateria'] ?? '');
    $modelo_placa = trim($_POST['placa'] ?? '');
    $tensao_sistema = trim($_POST['tensao'] ?? '');
    $estrutura_placa = trim($_POST['estrutura'] ?? '');

    $horas_autonomia = floatval($_POST['autonomia'] ?? '');

    // Mapa para descarregar bateria
    $mapa_descarga = [
        "bat30" => 30,
        "bat40" => 40,
        "bat50" => 50,
        "bat60" => 60,
        "bat70" => 70,
        "bat80" => 80
    ];

    // Mapa para tensão da bateria
    $mapa_tensao_bateria = [
        "tensao_bateria_12" => 12,
        "tensao_bateria_24" => 24,
        "tensao_bateria_48" => 48
    ];

    // Mapa de placas solares com os nomes completos
    $mapa_placa = [
        "MODULO FOTOVOLTAICO INTELBRAS 160W" => "MODULO FOTOVOLTAICO INTELBRAS 160W",
        "PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 440W" => "PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 440W",
        "PAINEL FOTOVOLTAICO MONOCRISTALINO SUNOVA 450W" => "PAINEL FOTOVOLTAICO MONOCRISTALINO SUNOVA 450W",
        "PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 500W" => "PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 500W",
        "PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 550W" => "PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 550W",
        "PAINEL FOTOVOLTAICO MONOCRISTALINO JA SOLAR 550W" => "PAINEL FOTOVOLTAICO MONOCRISTALINO JA SOLAR 550W",
        "PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 555W" => "PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 555W",
        "PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 555W" => "PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 555W",
        "PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 575W" => "PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 575W"
    ];
    $mapa_tensao_sistema = [
        "tensao_12" => 12,
        "tensao_24" => 24,
        "tensao_48" => 48,
        "tensao_127" => 127,
        "tensao_220" => 220
    ];

    $mapa_estrutura = [
        "SEM ESTRUTURA SOLAR" => "SEM ESTRUTURA SOLAR",
        "ESTRUTURA 1PLACA POSTE" => "ESTRUTURA 1PLACA POSTE",
        "ESTRUTURA 2PLACA POSTE" => "ESTRUTURA 2PLACA POSTE"
    ];

    // Validação de potência
    if (!is_numeric($potencia) || $potencia <= 0) {
        die("Erro: Informe uma potência válida!");
    }

    // Validação de modelo de bateria
    if ($modelo_bateria == "null" || empty($modelo_bateria)) {
        die("Erro: Selecione um modelo de bateria!");
    }

    // Validação de descarregar bateria
    if (!isset($mapa_descarga[$desc_bateria])) {
        die("Erro: Selecione um valor válido para a descarga da bateria!");
    }

    // Validação de tensão da bateria
    if (!isset($mapa_tensao_bateria[$tensao_bateria])) {
        die("Erro: Selecione um valor válido para a tensão da bateria!");
    }

    // Validação de modelo de placa solar
    if (!isset($mapa_placa[$modelo_placa])) {
        die("Erro: Selecione um modelo válido de placa solar!");
    }
    // Validação de tensao sistema
    if (!isset($mapa_tensao_sistema[$tensao_sistema])) {
        die("Erro: Selecione um modelo válido de placa solar!");
    }
    // Validação de horas autonomia
    if (!isset($horas_autonomia)) {
        die("Erro: Selecione uma hora válida!");
    }

    if (!isset($mapa_estrutura[$estrutura_placa])) {
        die("Erro: Selecione uma estrutura válida!");
    }

    $porcentagem_descarga = $mapa_descarga[$desc_bateria] / 100;
    $tensao_bateria_vdc = $mapa_tensao_bateria[$tensao_bateria];
    $tensao_op_sistema = $mapa_tensao_sistema[$tensao_sistema];

    // Buscar capacidade da bateria
    $sql_bateria = "SELECT capacidade_ah, sku, modelo FROM bateriasolar WHERE modelo = :modelo";
    $consulta_bateria = $pdo->prepare($sql_bateria);
    $consulta_bateria->execute([':modelo' => $modelo_bateria]);
    $bateria = $consulta_bateria->fetch(PDO::FETCH_ASSOC);

    if (!$bateria) {
        die("Erro: Modelo de bateria não encontrado!");
    }

    $capacidade_ah = intval($bateria['capacidade_ah']);
    echo "Número do AH da bateria selecionada: " . $capacidade_ah . "<br>";
    echo "Bateria será descarregada até: " . ($porcentagem_descarga * 100) . "%<br>";
    echo "Tensão da bateria é: " . ($tensao_bateria_vdc) . "<br>";
    $sku_bateria = $bateria['sku'];
    $modelo_bateria = $bateria['modelo'];

    // Buscar potência da placa solar
    $modelo_placa_sql = $mapa_placa[$modelo_placa]; // Nome completo para a consulta
    $sql_placa = "SELECT sku, potencia_max, tensao_circuito, corrente_curto FROM placasolar WHERE modelo = :modelo";
    $consulta_placa = $pdo->prepare($sql_placa);
    $consulta_placa->execute([':modelo' => $modelo_placa_sql]);
    $placa = $consulta_placa->fetch(PDO::FETCH_ASSOC);

    if (!$placa) {
        die("Erro: Modelo de placa solar não encontrado no banco de dados!");
    }

    $capacidade_placa = $placa['potencia_max'];
    echo "Potência da placa é: " . $capacidade_placa . "<br>";
    $tensao_placa = $placa['tensao_circuito'];
    $corrente_placa = $placa['corrente_curto'];
    $sku_placa = $placa['sku'];
    echo "Tensao da placa é:" . $tensao_placa . "<br>";
    echo "Corrente da placa é:" . $corrente_placa . "<br>";
    echo "Tensao do sistema: " . $tensao_op_sistema . "<br>";
    echo "Horas de autonomia: " . $horas_autonomia;
    echo "SKU da placa é: " . $sku_placa;

    $consumo_amper = $potencia / $tensao_bateria_vdc;
    echo "<br>Consumo de amper: " . number_format($consumo_amper, 2);
    $corrente_bateria = ($horas_autonomia * $consumo_amper) / $porcentagem_descarga;
    echo "<br>Corrente bateria: " . $corrente_bateria;
    $calculo_bateria_x = number_format(($corrente_bateria / $capacidade_ah) * ($tensao_bateria_vdc / 12), 2, '.', '');
    echo "<br>calculo x bateria: " . $calculo_bateria_x;
    $calculo_bateria_y = ($capacidade_ah / $capacidade_ah) * ($tensao_bateria_vdc / 12);
    echo "<br>calculo y bateria: " . $calculo_bateria_y;

    if ($calculo_bateria_y >= $calculo_bateria_x) {
        $calculo_bateria_z = number_format($calculo_bateria_y * 1, 3, '.', '');
        echo "<br>calculo z bateria: " . $calculo_bateria_z;
    } else {
        $calculo_bateria_z = $calculo_bateria_x * 1;
        echo "<br>calculo z bateria: " . $calculo_bateria_z;
    }

    $quantidade_bateria = round(round($calculo_bateria_z, 0) / ($tensao_bateria_vdc / 12), 0) * ($tensao_bateria_vdc / 12);
    echo "<br>Quantidade bateria: " . $quantidade_bateria;

    $corrente_carregar_bateria = number_format((($capacidade_ah * $quantidade_bateria) / ($tensao_bateria_vdc / 12)) * 0.10, 2, '.', '');
    echo "<br>Corrente necessário para carregar a bateria é:  " . $corrente_carregar_bateria;

    $potencia_recarga = (($tensao_bateria_vdc * 1.2) * $corrente_carregar_bateria) * 1;
    echo "<br>Potencia Necessária para Recarga:  " . $potencia_recarga;

    $potencia_sistema = $potencia_recarga + $potencia;
    echo "<br>Potencia Necessária para sistema:  " . $potencia_sistema;

    $potencia_recarga_pwm = number_format(($corrente_carregar_bateria / $corrente_placa) * 1, 2, '.', '');
    echo "<br>Potencia Necessaria PWM: " . $potencia_recarga_pwm;

    $potencia_sistema_pwm = number_format((($corrente_carregar_bateria + $consumo_amper) / $corrente_placa) * 1, 2, '.', '');
    echo "<br>Potencia Necessaria PWM: " . $potencia_sistema_pwm;
    $quantidade_placa_pwm = round($potencia_sistema_pwm);
    echo "<br>Quantidade placa PWM: " . $quantidade_placa_pwm;
    $quantidade_placa_mppt = ceil($potencia_sistema_pwm / $capacidade_placa);
    echo "<br>Quantidade placa MPPT: " . $quantidade_placa_mppt;
    $corrente_controlador_carga = ceil($corrente_carregar_bateria);
    echo "<br>Corrente Controlador de carga Ah: " . $corrente_controlador_carga;
    $potencia_inversor = $potencia;
    echo "<br>Potencia inversor: " . $potencia_inversor;


    echo "<ul>";
    echo "<li>Modelo da placa: " . $modelo_placa . "</li>";
    echo "<li>Quantidade da placa: " . $quantidade_placa_mppt . "</li>";
    echo "<li>SKU: " . $sku_placa . "</li>";
    echo "</ul>";

    echo "<ul>";
    echo "<li>Modelo da bateria: " . $modelo_bateria . "</li>";
    echo "<li>Quantidade da bateria: " . $quantidade_bateria . "</li>";
    echo "<li>SKU: " . $sku_bateria . "</li>";
    echo "</ul>";

    echo "<ul>";
    echo "<li>Estrutura da placa: " . $estrutura_placa . "</li>";
    echo "<li>Quantidade da bateria: " . $quantidade_bateria . "</li>";
    echo "<li>SKU: " . $sku_bateria . "</li>";
    echo "</ul>";



    /*CONTROLADOR DE CARGA */

    $sql_controlador = "SELECT sku, tensao_nominal_1, tensao_nominal_2, tensao_nominal_3, tensao_circuito_aberto_max, corrente_carga_nominal, eficiencia FROM controladorcarga";

    $consulta_controlador = $pdo->prepare($sql_controlador);
    $consulta_controlador->execute();
    $controlador_carga = $consulta_controlador->fetch(PDO::FETCH_ASSOC);
    $g7 = 24;


    $o25 = $tensao_placa * $quantidade_placa_mppt;
    $p30 = $o25 / 92;
    $q30 = $p30 * $corrente_placa;

    $r3 = "Valor Esperado";

    // Cenários de teste
    $cenarios = [
        [
            "Teste1" => ($corrente_controlador_carga <= 20),
            "Teste2" => (24 >= $tensao_bateria_vdc),
            "Teste3" => ceil($q30 / 20),
            "Teste4" => ("Valor Esperado" == $r3),
            "Resultado" => "CONTROLADOR DE CARGA EPEVER MPPT 20A",
            "SKU" => 22776
        ],
        [
            "Teste1" => ($corrente_controlador_carga > 20 && $corrente_controlador_carga <= 30),
            "Teste2" => (24 >= $tensao_bateria_vdc),
            "Teste3" => ceil($q30 / 30),
            "Teste4" => ("Valor Esperado" == $r3),
            "Resultado" => "CONTROLADOR DE CARGA EPEVER MPPT 30A",
            "SKU" => 22777
        ],
        [
            "Teste1" => ($corrente_controlador_carga > 30),
            "Teste2" => (24 >= $tensao_bateria_vdc),
            "Teste3" => ceil($q30 / 40),
            "Teste4" => ("Valor Esperado" == $r3),
            "Resultado" => "CONTROLADOR DE CARGA EPEVER MPPT 40A",
            "SKU" => 22778
        ],
        [
            "Teste1" => ($corrente_controlador_carga > 0 && $corrente_controlador_carga <= 40),
            "Teste2" => (48 >= $tensao_bateria_vdc),
            "Teste3" => ceil($q30 / 40),
            "Teste4" => ("Valor Esperado" == $r3),
            "Resultado" => "CONTROLADOR DE CARGA EPEVER MPPT 40A",
            "SKU" => 22779
        ],
        [
            "Teste1" => ($corrente_controlador_carga > 40 && $corrente_controlador_carga <= 50),
            "Teste2" => (48 >= $tensao_bateria_vdc),
            "Teste3" => ceil($q30 / 50),
            "Teste4" => ("Valor Esperado" == $r3),
            "Resultado" => "CONTROLADOR DE CARGA EPEVER MPPT 50A",
            "SKU" => 22780
        ],
        [
            "Teste1" => ($corrente_controlador_carga > 50 && $corrente_controlador_carga <= 60),
            "Teste2" => (48 >= $tensao_bateria_vdc),
            "Teste3" => ceil($q30 / 60),
            "Teste4" => ("Valor Esperado" == $r3),
            "Resultado" => "CONTROLADOR DE CARGA EPEVER MPPT 60A",
            "SKU" => 22781
        ],
        [
            "Teste1" => ($corrente_controlador_carga > 50 && $corrente_controlador_carga <= 60),
            "Teste2" => (48 >= $tensao_bateria_vdc),
            "Teste3" => ceil($q30 / 60),
            "Teste4" => ("Valor Esperado" == $r3),
            "Resultado" => "CONTROLADOR DE CARGA EPEVER MPPT 60A",
            "SKU" => 22782
        ]

    ];

    // Verificação dos cenários

   foreach ($cenarios as $cenario) {
        if ($cenario["Teste1"] && $cenario["Teste2"] && $cenario["Teste3"] && $cenario["Teste4"]) {
            echo "<ul>";
            echo "<li>Resultado: " . $cenario["Resultado"] . "</li>";
            echo "<li>Quantidade: " . $cenario["Teste3"] . "</li>";
            echo "<li>SKU: " . $cenario["SKU"] . "</li>";
            echo "</ul>";
            break; // Para no primeiro que for verdadeiro
        }
    }
}
