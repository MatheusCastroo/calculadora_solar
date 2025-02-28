// Crie um vetor para armazenar as informações dos equipamentos
let equipamentos = [];
let somaTotal = 0; // Variável para rastrear a soma total

// Função para limpar os campos de entrada no contêiner
function limparCampos() {
    document.getElementById('equipamento').value = ''; // Limpa o campo de descrição do equipamento
    document.getElementById('potencia').value = ''; // Limpa o campo de potência
    document.getElementById('quantidade_equip').value = ''; // Limpa o campo de quantidade de equipamento
    document.getElementById('hdia').value = ''; // Limpa o campo de horas de uso diário
}

// Função para calcular e adicionar o equipamento
function multiplicarCampos() {
    let equip = document.getElementById('equipamento').value; // Obtém o valor do campo de descrição do equipamento
    let potencia = document.getElementById('potencia').value; // Obtém o valor do campo de potência
    let qtd_equip = document.getElementById('quantidade_equip').value; // Obtém o valor do campo de quantidade de equipamento
    let hdia = document.getElementById('hdia').value; // Obtém o valor do campo de horas de uso diário
    let res = document.getElementById('res'); // Elemento HTML para exibir o resultado

    // Verifica se algum campo está vazio
    if (equip.length <= 0 || potencia.length <= 0 || qtd_equip.length <= 0 || hdia.length <= 0) {
        window.alert('[ERRO] Faltam dados!');
    } else {
        // Converte os valores para números
        potencia = Number(potencia);
        qtd_equip = Number(qtd_equip);
        hdia = Number(hdia);

        // Verifica se os valores são maiores ou iguais a zero
        if (potencia >= 0 && qtd_equip >= 0 && hdia >= 0) {
            let resultado = potencia * qtd_equip * hdia; // Calcula o consumo diário do equipamento
            res.innerHTML = resultado + ' Wh/dia'; // Exibe o resultado no HTML

            // Crie um objeto para representar o equipamento
            let equipamento = {
                descricao: equip, // Descrição do equipamento
                potencia: potencia, // Potência do equipamento
                quantidade: qtd_equip, // Quantidade de equipamento
                horasDeUso: hdia, // Horas de uso diário
                consumoDiario: resultado // Consumo diário do equipamento
            };

            // Adicione o objeto ao vetor de equipamentos
            equipamentos.push(equipamento);

            // Atualize a soma total
            somaTotal += resultado;

            // Atualize a lista de equipamentos e a soma total no HTML
            atualizarListaEquipamentos();
            atualizarSomaTotal();

            // Limpe os campos de entrada no contêiner
            limparCampos();
        } else {
            window.alert('Os valores de potência, quantidade e horas de uso devem ser maiores que 1.');
        }
    }
}

// Função para atualizar a lista de equipamentos no HTML
function atualizarListaEquipamentos() {
    let listaEquip = document.querySelector('.lista_equip');
    listaEquip.innerHTML = '<h2>Lista de Equipamentos</h2>';

    // Itere sobre o vetor de equipamentos e adicione cada equipamento à lista
    equipamentos.forEach(function (equipamento) {
        let equipamentoInfo = `${equipamento.descricao} - ${equipamento.consumoDiario} Wh/dia`;
        let p = document.createElement('p'); // Cria um elemento de parágrafo
        p.textContent = equipamentoInfo; // Define o texto do parágrafo
        listaEquip.appendChild(p); // Adiciona o parágrafo à lista de equipamentos
    });
}

// Função para atualizar a soma total no HTML
function atualizarSomaTotal() {
    let res = document.getElementById('res');
    res.innerHTML = somaTotal + ' Wh/dia';
}

// Crie um objeto com as opções de estados para cada região
// Crie um objeto com as opções de estados para cada região
const estadosPorRegiao = {
    norte: ["Acre", "Amapá", "Amazonas", "Pará", "Rondônia", "Roraima", "Tocantins"],
    nordeste: ["Alagoas", "Bahia", "Ceará", "Maranhão", "Paraíba", "Pernambuco", "Piauí", "Rio Grande do Norte", "Sergipe"],
    oeste: ["Distrito Federal", "Goiás", "Mato Grosso", "Mato Grosso do Sul"],
    sudeste: ["Espírito Santo", "Minas Gerais", "Rio de Janeiro", "São Paulo"],
    sul: ["Paraná", "Rio Grande do Sul", "Santa Catarina"]
};

// Função para carregar os estados com base na região selecionada
function carregarEstados() {
    const regiaoSelect = document.getElementById('regiao');
    const estadoSelect = document.getElementById('estado');

    // Limpa as opções atuais do elemento select dos estados
    estadoSelect.innerHTML = '';

    // Obtém a região selecionada
    const regiaoSelecionada = regiaoSelect.value;

    // Verifica se a região selecionada está no objeto de estados
    if (regiaoSelecionada in estadosPorRegiao) {
        // Adicione uma opção em branco como opção inicial
        const optionEmBranco = document.createElement('option');
        optionEmBranco.value = '';
        optionEmBranco.textContent = '';
        estadoSelect.appendChild(optionEmBranco);

        // Adiciona as opções de estados para a região selecionada
        estadosPorRegiao[regiaoSelecionada].forEach((estado) => {
            const option = document.createElement('option');
            option.value = estado.toLowerCase().replace(/\s/g, '_');
            option.textContent = estado;
            estadoSelect.appendChild(option);
        });
    }
}

// Adicione um ouvinte de eventos para o elemento select da região
document.getElementById('regiao').addEventListener('change', carregarEstados);

// Inicialize a lista de estados com uma opção em branco
carregarEstados();

function montagemSolar() {
    let selectPlaca = document.getElementById('placa');
    let selectBateria = document.getElementById('modelo_bateria');
    let selectTensao = document.getElementById('tensao').value; // Obter o valor selecionado da tensão do inversor
    let selectTensao_Bat = document.getElementById('tensao-bateria').value; // Obter o valor selecionado da tensão da bateria
    let selectEstrutura = document.getElementById('estrutura');

    // Exibir o texto das opções selecionadas
    let placa = selectPlaca.options[selectPlaca.selectedIndex].text;
    let bateria = selectBateria.options[selectBateria.selectedIndex].text;
    let modeloBateria = selectBateria.options[selectBateria.selectedIndex].text;
    let estrutura = selectEstrutura.options[selectEstrutura.selectedIndex].text;
    let inversor = "";

    if (selectTensao === "tensao_127" && selectTensao_Bat === "tensao_bateria_12") {
        inversor = "INVERSOR SENOIDAL 350W 12V/110V IP 350-11 EPEVER";
    } else if (selectTensao === "tensao_127" && selectTensao_Bat === "tensao_bateria_24") {
        inversor = "INVERSOR DE TENSÃO SENOIDAL 750W ISV 751 INTELBRAS";
    } else if (selectTensao === "tensao_127" && selectTensao_Bat === "tensao_bateria_48") {
        inversor = "INVERSOR SENOIDAL 4000W 48V/110V IP400-41-PLUS(T) EPEVER";
    } else if (selectTensao == "tensao_220" && selectTensao_Bat === "tensao_bateria_24") {
        inversor = "INVERSOR SONOIDAL 2000W 24v/220v IP 2000-22-PLUS(T) EPEVER";
    } else if (selectTensao == "tensao_220" && selectTensao_Bat === "tensao_bateria_48") {
        inversor = "INVERSOR DENOIDAL 4000W 48v/220 IP 4000-42-PLUS(T) EPEVER";
    } else {
        inversor = "";
    }

    // Crie uma lista para as informações
    let listaMontagem = document.createElement('ul');

    // Adicione a placa à lista
    let liPlaca = document.createElement('li');
    liPlaca.innerHTML = "<strong>Placa:</strong> " + placa;
    listaMontagem.appendChild(liPlaca);

    // Adicione a bateria à lista
    let liBateria = document.createElement('li');
    liBateria.innerHTML = "<strong>Bateria:</strong> " + bateria;
    listaMontagem.appendChild(liBateria);

    // Adicione o modelo de bateria à lista
    let liModeloBateria = document.createElement('li');
    liModeloBateria.innerHTML = "<strong>Modelo de Bateria:</strong> " + modeloBateria;
    listaMontagem.appendChild(liModeloBateria);

    // Adicione a estrutura à lista
    let liEstrutura = document.createElement('li');
    liEstrutura.innerHTML = "<strong>Estrutura:</strong> " + estrutura;
    listaMontagem.appendChild(liEstrutura);
    
    // Adicione o inversor à lista
    let liInversor = document.createElement('li');
    liInversor.innerHTML = "<strong>Inversor:</strong> " + inversor;
    listaMontagem.appendChild(liInversor);

    // Exiba a <div class="montagemGerador"> após clicar no botão "Montagem"
    let divMontagemGerador = document.querySelector('.montagemGerador');
    divMontagemGerador.style.display = 'block';

    // Atualize o <h2> para "Lista do Gerador"
    let h2MontagemGerador = document.querySelector('.montagemGerador h2');
    h2MontagemGerador.textContent = 'Lista do Gerador';

    // Limpe o conteúdo anterior da lista e adicione a nova lista
    let listaAntiga = document.querySelector('.montagemGerador ul');
    listaAntiga.innerHTML = '';
    listaAntiga.appendChild(listaMontagem);
}