<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,700&display=swap" rel="stylesheet">
    <title>Calculadora off grid</title>
</head>

<body>
    <main>
        <form method="post" action="calculo.php">
             
            <div class="container-wrapper">
                <div class="imagem">
                    <img src="imagens/nova_capa_login.0120de02.jpg" alt="imagem" class="imagem_offgrid">
                </div>
                <div class="resultado">
                    <div class="itens">
                        <div id="etapa-placa" class="etapa ativa">
                            <h2>Selecione as opções da placa</h2>
                            <div class="placa">
                                <label for="placa">Modelo da placa</label>
                                <select name="placa" id="placa">
                                    <option disabled selected value="">Selecione uma opção</option>
                                    <option value="MODULO FOTOVOLTAICO INTELBRAS 160W">Módulo Fotovoltaico Intelbras 160W - Cód.18450</option>
                                    <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 440W">Painel Fotovoltaico Monocristalino Canadian 440W - Cód.20745</option>
                                    <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO SUNOVA 450W">Painel Fotovoltaico Monocristalino Sunova 450W - Cód.22444</option>
                                    <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 500W">Painel Fotovoltaico Monocristalino Sine Energy 500W - Cód.22473</option>
                                    <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 550W">Painel Fotovoltaico Monocristalino Canadian 550W - Cód.26035</option>
                                    <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO JA SOLAR 550W">Painel Fotovoltaico Monocristalino JA Solar 550W - Cód.26863</option>
                                    <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 555W">Painel Fotovoltaico Monocristalino Sine Energy 555W - Cód.28824</option>
                                    <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 555W">Painel Fotovoltaico Monocristalino Znshine 555W - Cód.28864</option>
                                    <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 575W">Painel Fotovoltaico Monocristalino Znshine 575W - Cód.26386</option>
                                </select>
                            </div>
                            <div class="tensao">
                                <label for="tensao">Tensão de operação do sistema</label>
                                <select name="tensao" id="tensao">
                                    <option disabled selected value="">Selecione uma opção</option>
                                    <option value="tensao_12" id="tensao_12">12 Vdc</option>
                                    <option value="tensao_24" id="tensao_24">24 Vdc</option>
                                    <option value="tensao_48" id="tensao_48">48 Vdc</option>
                                    <option value="tensao_127" id="tensao_127">127 Vca</option>
                                    <option value="tensao_220" id="tensao_220">220 Vca</option>
                                </select>
                            </div>
                            <div class="tipo_estruta">
                                <label for="inversor">Tipo de estrutura</label>
                                <select name="estrutura" id="estrutura">
                                    <option disabled selected value="">Selecione uma opção</option>
                                    <option value="SEM ESTRUTURA SOLAR">SEM ESTRUTURA SOLAR</option>
                                    <option value="ESTRUTURA 1PLACA POSTE">ESTRUTURA 1PLACA POSTE - Cód.21749</option>
                                    <option value="ESTRUTURA 2PLACA POSTE">ESTRUTURA 2PLACA POSTE - Cód.28521</option>
                                </select>
                            </div>
                            <div class="potencia">
                                <label for="potencia">Potência dos equipamentos em Watt (W)</label>
                                <input type="number" name="potencia" id="potencia" min="1" required>
                            </div>
                            <button type="button" onclick="irParaEtapa('etapa-bateria')" class="btn-proximo">Próximo</button>
                        </div>
                        <div id="etapa-bateria" class="etapa">
                            <div class="bateria">
                                <h2>Selecione as opções da bateria</h2>
                                <div class="tensao_operacao_sistema">
                                    <label for="tensao_bateria">Tensão do banco de bateria</label>
                                    <select name="tensao_bateria" id="tensao_bateria">
                                        <option disabled selected value="">Selecione uma opção</option>
                                        <option value="tensao_bateria_12">12 Vdc</option>
                                        <option value="tensao_bateria_24">24 Vdc</option>
                                        <option value="tensao_bateria_48">48 Vdc</option>
                                    </select>
                                </div>
                                <div class="modelo_bateria">
                                <label for="modelo_bateria">Modelo da bateria</label>
                                <select name="modelo_bateria" id="modelo_bateria">
                                    <option disabled selected value="">Selecione uma opção</option>
                                    <option value="BATERIA SELADA SOLAR 12V 220AH MOURA">BATERIA SELADA SOLAR 12V 220AH MOURA - Cód.27919</option>
                                    <option value="BATERIA ESTACIONARIA 12V 45AH INTELBRAS">BATERIA ESTACIONARIA 12V 45AH INTELBRAS - Cód.27612</option>
                                    <option value="BATERIA ESTACIONARIA 12V 60AH INTELBRAS">BATERIA ESTACIONARIA 12V 60AH INTELBRAS - Cód.27548</option>
                                    <option value="BATERIA SOLAR 12-150AH ELO SOLAR">BATERIA SOLAR 12-150AH ELO SOLAR - Cód.24231</option>
                                    <option value="BATERIA ESTACIONARIA 12V 45AH MOURA">BATERIA ESTACIONARIA 12V 45AH MOURA - Cód.28887</option>
                                </select>
                                </div>
                                <div class="descarregar_bateria">
                                    <label for="descarregar_bateria">Descarregar baterias até (%)</label>
                                    <select name="descarregar_bateria" id="descarregar_bateria">
                                        <option disabled selected value="">Selecione uma opção</option>
                                        <option value="bat30">30%</option>
                                        <option value="bat40">40%</option>
                                        <option value="bat50">50%</option>
                                        <option value="bat60">60%</option>
                                        <option value="bat70">70%</option>
                                        <option value="bat80">80%</option>
                                    </select>
                                </div>
                                <div class="autonomia">
                                    <label for="autonomia">Autonomia (Horas)</label>
                                    <input type="number" name="autonomia" id="autonomia">
                                </div>
                                <div class="botoes-final">
                                    <button type="button" class="voltar"
                                        onclick="irParaEtapa('etapa-placa')">Voltar</button>
                                    <button type="button" onclick="validarFormulario()" class="montagem" id="montagemSolar">Montagem</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>              
            </div>
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>