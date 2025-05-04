<?php
session_start();
// Recuperando as variáveis da sessão
$modelo_placa = $_SESSION['modelo_placa'];
$quantidade_placa_mppt = $_SESSION['quantidade_placa_mppt'];
$sku_placa = $_SESSION['sku_placa'];
$cenarios_inversor = $_SESSION['cenarios_inversor'];
$cenarios_controlador = $_SESSION['cenarios_controlador'];
$modelo_bateria = $_SESSION['modelo_bateria'];
$quantidade_bateria = $_SESSION['quantidade_bateria'];
$sku_bateria = $_SESSION['sku_bateria'];
$estrutura_placa = $_SESSION['estrutura_placa'];

// Lógica de exibição dos dados
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado dos Componentes</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="resultado.css"> <!-- Arquivo CSS externo -->

    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,700&display=swap" rel="stylesheet">

</head>
<body>

<div class="resultado_wrapper">
    <div class="resultado_container">

        <!-- Painel Solar -->
        <div class="resultado_card">
            <h3><i class="fas fa-solar-panel"></i> Painel Solar</h3>
            <p><strong>Modelo:</strong> <?= $modelo_placa ?></p>
            <p class="inline_info">
                <span><strong>Quantidade:</strong> <?= $quantidade_placa_mppt ?></span>
                <span><strong>SKU:</strong> <?= $sku_placa ?></span>
            </p>
        </div>

        <!-- Inversor -->
        <?php foreach ($cenarios_inversor as $cenario): ?>
            <?php if ($cenario["Teste1"] && $cenario["Teste2"] && $cenario["Teste3"] && $cenario["Teste4"]): ?>
                <div class="resultado_card">
                    <h3><i class="fas fa-bolt"></i> Inversor</h3>
                    <p><strong>Resultado:</strong> <?= $cenario["Resultado"] ?></p>
                    <p class="inline_info">
                        <span><strong>Quantidade:</strong> <?= $cenario["Quantidade"] ?></span>
                        <span><strong>SKU:</strong> <?= $cenario["SKU"] ?></span>
                    </p>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Controlador -->
        <?php foreach ($cenarios_controlador as $cenario): ?>
            <?php if ($cenario["Teste1"] && $cenario["Teste2"] && $cenario["Teste3"] && $cenario["Teste4"]): ?>
                <div class="resultado_card">
                    <h3><i class="fas fa-microchip"></i> Controlador</h3>
                    <p><strong>Resultado:</strong> <?= $cenario["Resultado"] ?></p>
                    <p class="inline_info">
                        <span><strong>Quantidade:</strong> <?= $cenario["Teste3"] ?></span>
                        <span><strong>SKU:</strong> <?= $cenario["SKU"] ?></span>
                    </p>
                </div>
                <?php break; ?>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Bateria -->
        <div class="resultado_card">
            <h3><i class="fas fa-battery-full"></i> Bateria</h3>
            <p><strong>Modelo:</strong> <?= $modelo_bateria ?></p>
            <p class="inline_info">
                <span><strong>Quantidade:</strong> <?= $quantidade_bateria ?></span>
                <span><strong>SKU:</strong> <?= $sku_bateria ?></span>
            </p>
        </div>

        <!-- Estrutura -->
        <div class="resultado_card">
            <h3><i class="fas fa-tools"></i> Estrutura</h3>
            <p><strong>Modelo:</strong> <?= $estrutura_placa ?></p>
            <?php
            if ($estrutura_placa == "ESTRUTURA 1PLACA POSTE") {
                $quantidade_estrutura = ceil($quantidade_placa_mppt / 1);
                $sku_estrutura = "21749";
            } else if ($estrutura_placa == "ESTRUTURA 2PLACA POSTE") {
                $quantidade_estrutura = ceil($quantidade_placa_mppt / 2);
                $sku_estrutura = "28521";
            }
            else {
                $quantidade_estrutura = "";
                $sku_estrutura = "";
            }
            ?>
            <p class="inline_info">
                <span><strong>Quantidade:</strong> <?= $quantidade_estrutura ?></span>
                <span><strong>SKU:</strong> <?= $sku_estrutura ?></span>
            </p>
        </div>

        <a href="index.php" class="voltar">Voltar</a>
    </div>
</div>

</body>
</html>