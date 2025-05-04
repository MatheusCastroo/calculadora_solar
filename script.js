function irParaEtapa(id) {
  document.querySelectorAll('.etapa').forEach(div => {
    div.classList.remove('ativa');
  });
  document.getElementById(id).classList.add('ativa');
}

function validarFormulario() {
    // Lista com os IDs e os nomes dos campos
    const campos = [
        { id: 'placa', nome: 'Modelo da placa' },
        { id: 'tensao', nome: 'Tensão de operação do sistema' },
        { id: 'potencia', nome: 'Potência dos equipamentos em Watt (W)' },
        { id: 'estrutura', nome: 'Tipo de estrutura' },
        { id: 'tensao_bateria', nome: 'Tensão do banco de bateria' },
        { id: 'modelo_bateria', nome: 'Modelo da bateria' },
        { id: 'descarregar_bateria', nome: 'Descarregar baterias até (%)' },
        { id: 'autonomia', nome: 'Autonomia (Horas)' }
    ];

    let camposNaoPreenchidos = [];

    campos.forEach(campo => {
        const input = document.getElementById(campo.id);
        if (!input.value.trim()) {
            camposNaoPreenchidos.push(campo.nome);
            input.classList.add('campo-invalido');
        } else {
            input.classList.remove('campo-invalido');
        }
    });

    if (camposNaoPreenchidos.length > 0) {
        alert('Por favor, preencha os seguintes campos obrigatórios:\n\n' + camposNaoPreenchidos.join('\n'));
        return false;
    }

    document.querySelector('form').submit();
}