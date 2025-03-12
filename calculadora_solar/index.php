<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculadora off grid</title>
</head>

<body>
    <header>
        <h1>Teste Solar</h1>
    </header>
    <main>
        <form method="post" action="calculo.php">
            <div class="container-wrapper">
                <!-- <div class="container">
                <div class="equipamento">
                    <label for="equipamento">Descrição do Equipamento</label>
                    <input type="text" name="equipamento" id="equipamento" placeholder="Ex: Lâmpada" required>
                </div>
                <div class="potencia_w">
                    <label for="potencia_w">Potência dos equipamentos em Watt (W)</label>
                    <input type="number" name="potencia_w" id="potencia_w" min="1" required>
                </div>
                <div class="quantidade_equip">
                    <label for="quantidade_equip">Quantidade</label>
                    <input type="number" name="quantidade_equip" id="quantidade_equip" min="1" required>
                </div>
                <div class="hdia">
                    <label for="hdia">Horas de uso diário</label>
                    <input type="number" name="hdia" id="hdia" min="0.1" required>
                </div>
                <button onclick="multiplicarCampos()" id="verificar">Verificar</button>
                <div class="resultado">
                    <label for="res">Consumo Diário do(s) Equipamento(s)</label>
                    <span id="res">0 Wh/dia</span>
                </div>
                <div class="lista_equip">
                    <h2>Lista de Equipamentos</h2>
                </div>
            </div-->
                <div class="container2">
                    <div class="inversor">
                        <h2>Placa</h2>
                        <div class="placa">
                            <label for="placa">Modelo da placa</label>
                            <select name="placa" id="placa">
                                <option disabled selected value="null">Selecione uma opção</option>
                                <option value="MODULO FOTOVOLTAICO INTELBRAS 160W">Módulo Fotovoltaico Intelbras 160W</option>
                                <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 440W">Painel Fotovoltaico Monocristalino Canadian 440W</option>
                                <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO SUNOVA 450W">Painel Fotovoltaico Monocristalino Sunova 450W</option>
                                <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 500W">Painel Fotovoltaico Monocristalino Sine Energy 500W</option>
                                <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO CANADIAN 550W">Painel Fotovoltaico Monocristalino Canadian 550W</option>
                                <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO JA SOLAR 550W">Painel Fotovoltaico Monocristalino JA Solar 550W</option>
                                <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO SINE ENERGY 555W">Painel Fotovoltaico Monocristalino Sine Energy 555W</option>
                                <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 555W">Painel Fotovoltaico Monocristalino Znshine 555W</option>
                                <option value="PAINEL FOTOVOLTAICO MONOCRISTALINO ZNSHINE 575W">Painel Fotovoltaico Monocristalino Znshine 575W</option>
                            </select>

                        </div>
                        <div class="tensao">
                            <label for="tensao">Tensão de operação do sistema</label>
                            <select name="tensao" id="tensao">
                                <option disabled selected value="null">Selecione uma opção</option>
                                <option value="tensao_12" id="tensao_12">12 Vdc</option>
                                <option value="tensao_24" id="tensao_24">24 Vdc</option>
                                <option value="tensao_48" id="tensao_48">48 Vdc</option>
                                <option value="tensao_127" id="tensao_127">127 Vca</option>
                                <option value="tensao_220" id="tensao_220">220 Vca</option>
                            </select>
                        </div>
                        <div class="potencia">
                            <label for="potencia">Potência dos equipamentos em Watt (W)</label>
                            <input type="number" name="potencia" id="potencia" min="1" required>
                        </div>
                        <div class="tipo_estruta">
                            <label for="inversor">Tipo de estrutura</label>
                            <select name="estrutura" id="estrutura">
                                <option disabled selected value="null">Selecione uma opção</option>
                                <option value="SEM ESTRUTURA SOLAR">SEM ESTRUTURA SOLAR</option>
                                <option value="ESTRUTURA 1PLACA POSTE">ESTRUTURA 1PLACA POSTE</option>
                                <option value="ESTRUTURA 2PLACA POSTE">ESTRUTURA 2PLACA POSTE</option>
                            </select>
                        </div>
                        <div class="montagemGerador"> <!-- Adicione style="display: none;" para ocultar a <div> inicialmente -->
                            <h2>Lista do Gerador</h2>
                            <ul>
                                <!-- As informações geradas pela função montagemSolar serão inseridas aqui como <li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="bateria">
                        <h2>Bateria</h2>
                        <div class="tensao_operacao_sistema">
                            <label for="tensao_bateria">Tensão do banco de bateria</label>
                            <select name="tensao_bateria" id="tensao_bateria">
                                <option disabled selected value="">Selecione uma opção</option>
                                <option value="tensao_bateria_12">12 Vdc</option>
                                <option value="tensao_bateria_24">24 Vdc</option>
                                <option value="tensao_bateria_48">48 Vdc</option>
                            </select>
                        </div>
                        <label for="modelo_bateria">Modelo da bateria</label>
                        <select name="modelo_bateria" id="modelo_bateria">
                            <option disabled selected value="null">Selecione uma opção</option>
                            <option value="BATERIA SELADA SOLAR 12V 220AH MOURA">BATERIA SELADA SOLAR 12V 220AH MOURA</option>
                            <option value="BATERIA ESTACIONARIA 12V 45AH INTELBRAS">BATERIA ESTACIONARIA 12V 45AH INTELBRAS</option>
                            <option value="BATERIA ESTACIONARIA 12V 60AH INTELBRAS">BATERIA ESTACIONARIA 12V 60AH INTELBRAS</option>
                            <option value="BATERIA SOLAR 12-150AH ELO SOLAR">BATERIA SOLAR 12-150AH ELO SOLAR</option>
                        </select>

                        <div class="descarregar_bateria">
                            <label for="descarregar_bateria">Descarregar baterias até (%)</label>
                            <select name="descarregar_bateria" id="descarregar_bateria">
                                <option disabled selected value="null">Selecione uma opção</option>
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
                    </div>
                    <div class="local">
                        <h2>Local de Instalação</h2>
                        <div class="regiao">
                            <label for="regiao">Região</label>
                            <select name="regiao" id="regiao" onchange="carregarEstados()">
                                <option disabled selected value="null">Selecione uma opção</option>
                                <option value="norte">Norte</option>
                                <option value="nordeste">Nordeste</option>
                                <option value="oeste">Centro-Oeste</option>
                                <option value="sudeste">Sudeste</option>
                                <option value="sul">Sul</option>
                            </select>
                        </div>
                        <div class="estado">
                            <label for="estado">Estados</label>
                            <select name="estado" id="estado">
                                <option disabled selected value="null">Selecione uma opção</option>
                                <!-- Opções de estados serão carregadas dinamicamente aqui -->
                            </select>
                        </div>
                        <button onclick="montagemSolar()" id="montagemSolar">Montagem</button>
                    </div>
                </div>
            </div>
            <button type="submit">Enviar Formulário</button> <!-- Botão para envio -->
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>
