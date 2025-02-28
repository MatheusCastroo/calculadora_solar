<?php
require 'conexao.php'; // Importa a conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores do formulário
    $potencia = isset($_POST['potencia']) ? trim($_POST['potencia']) : '';
    $modelo_bateria = isset($_POST['modelo_bateria']) ? $_POST['modelo_bateria'] : '';

    // Validação da potência
    if (empty($potencia) || !is_numeric($potencia) || $potencia <= 0) {
        echo "Erro: Informe uma potência válida!";
        exit;
   }

    // Validação do modelo de bateria
    if ($modelo_bateria == "null" || empty($modelo_bateria)) {
        echo "Erro: Selecione um modelo de bateria!";
        exit;
    }

    // Corrigindo o nome da variável de conexão
    global $pdo;

    // Consulta ao banco para obter capacidade da bateria baseada no modelo
    $sql = "SELECT capacidade_ah FROM bateriasolar WHERE modelo = :modelo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':modelo', $modelo_bateria, PDO::PARAM_STR);
    $stmt->execute();

    //Verifica se encontrou a bateria no banco
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($modelo_bateria == $stmt) {
            echo "Número do AH da bateria selecionada: " . $row['capacidade_ah'];
        }
        else {
            echo 'teste';
        }
        
    } else {
        echo "Erro: Modelo de bateria não encontrado!";
    }
    /*O código está validando a descrição da bateria do formulário com a coluna de AH, ele deve validar o descrição com a coluna de descrição e retornar o AH*/
}
 
