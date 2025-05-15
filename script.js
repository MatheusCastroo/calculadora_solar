function irParaEtapa(id) {
  document.querySelectorAll('.etapa').forEach(div => {
    div.classList.remove('ativa');
  });
  document.getElementById(id).classList.add('ativa');
}

function validarFormulario() {
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
  let primeiroCampoInvalido = null;

  campos.forEach(campo => {
    const input = document.getElementById(campo.id);
    const erroMensagem = input.parentElement.querySelector('.erro-mensagem');

    if (!input.value.trim()) {
      camposNaoPreenchidos.push(campo.nome);
      input.classList.add('campo-invalido');
      if (erroMensagem) erroMensagem.style.display = 'block';
      if (!primeiroCampoInvalido) primeiroCampoInvalido = input;
    } else {
      input.classList.remove('campo-invalido');
      if (erroMensagem) erroMensagem.style.display = 'none';
    }
  });

  if (camposNaoPreenchidos.length > 0) {
    // Apenas exibe os avisos visuais, sem alert e sem submit
    return false;
  }

  document.querySelector('form').submit();
}
