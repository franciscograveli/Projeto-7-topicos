<?php
//Relógio
date_default_timezone_set('America/Sao_Paulo');
if (isset($_POST['mostrahora1'])) {
    $data = getdate();
    $hora = "$data[hours]:$data[minutes]:$data[seconds] ";
    $dia = "$data[weekday],  $data[mday] de $data[month] de $data[year]";
    echo json_encode($hora . $dia);
}

if (isset($_POST['mostrahora2'])) {
    $data2 = new DateTime();
    $diaHora =  $data2->format('d/m/Y H:i:s');
    echo json_encode($diaHora);
}

if (isset($_POST['mostrahora3'])) {
    $unix = "Unix : " . strtotime("now") . 's';
    echo json_encode($unix);
}

if (isset($_POST['valFatorar']) && isset($_POST['fatForm'])) {
    require './funcoes/fatorial.php';
    $numero = (int)($_POST['valFatorar']);
    echo fatorial($numero);
}

if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['calcForm'])) {
    require './funcoes/calculadora.php';
    $calc = new calculadora();

    $a = $_POST['a'];
    $b = $_POST['b'];
    $resultado = $calc->soma($a, $b);
    echo $resultado;
}

if (isset($_POST['email']) && isset($_POST['msgForm'])) {
    require './funcoes/enviaremail.php';
    $primeiroNome = strtok(ucwords(strtolower($_POST['nome']))); //pegando o primeiro nome
    $nome = $_POST['nome']; // pega o nome inteiro e ajusta padroniza começando com a primeira letra maiuscula em cada palavra
    $email = $_POST['email'];
    $msg = $_POST['msg'];
    echo enviarEmail($primeiroNome, $email, $msg);
}

//calculadora:
if (isset($_POST['somar'])) {
    require '../php/funcoes/calculadora.php';
    $calc = new calculadora();
    $calc = $calc->soma($_POST['a'], $_POST['b']);
    echo json_encode($calc);
}
if (isset($_POST['subtrair'])) {
    require '../php/funcoes/calculadora.php';
    $calc = new calculadora();
    $calc = $calc->sub($_POST['a'], $_POST['b']);
    echo json_encode($calc);
}
if (isset($_POST['multiplicar'])) {
    require '../php/funcoes/calculadora.php';
    $calc = new calculadora();
    $calc = $calc->mult($_POST['a'], $_POST['b']);
    echo json_encode($calc);
}
if (isset($_POST['dividir'])) {
    require '../php/funcoes/calculadora.php';
    $calc = new calculadora();
    $calc = $calc->div($_POST['a'], $_POST['b']);
    echo json_encode($calc);
}
//





// /////////////////////////////
//PHP - Exibir Tabela produtos
if (isset($_POST['show'])) {
    require_once '../../index.php';
}

require '../php/model.php';

$retorno = consultarTabela('produtos'); // solicitando matriz associativa da tabela para o model
$nomeI = '';
$precoI = '';

// exibindo tabela
if ($retorno->num_rows > 0) { //verificando se a tabela não está vazia
    echo "<table  class='tabela'>";
    echo "
            <tr>
                <th id='thId'>ID:</th>
                <th>Nome:</th>
                <th>Preço:</th>
            </tr>
            ";
    while ($row = $retorno->fetch_assoc()) {
        echo "<tr>
                        <td id='idTabela'>" . $row["id"] . "</td>
                        <td>" . $row["nome"] . "</td>
                        <td>" . $row["preco"] . "</td>
                        <td id='botaoTabela'><a href='controller.php?id=$row[id]#resultado'>Editar</a></td>
                    </tr>";
    }
}
//
if (!empty($_GET['id'])) { //verificando se o id não está vazio 
    $id = $_GET['id'];

    $resultadoById = consultarTabelaPorId('produtos', $id); //definindo uma variavel para guardar o resultado da busca por id
    if ($resultadoById->num_rows > 0) {
        while ($produto = $resultadoById->fetch_assoc()) { //utilizando a var $produto como uma matriz associativa (fetch_assoc) para poder trabalhar com o banco
            $nomeI = $produto['nome'];
            $precoI = $produto['preco'];
        }
    }
    if (isset($_POST['update'])) { //verificando se o id não está vazio 
        //definindo a variavel $id utilizando get pois o id é passado na url
        $nomeI = $_POST['nomeItem'];
        $precoI = $_POST['precoItem'];
        editarTabela('produtos', $nomeI, $precoI, $id);
        require_once '../../index.php';
    }
    require_once '../../index.php';
}
