<?php
class ContruirTabela
{
    private $tabela = 'produtos';

    public function montaTabela()
    {
        require_once 'model.php';
        $dados = consultarTabela($this->tabela);

        $tabela = '<table class="tabela">';
        $tabela .= '<tr>';
        $tabela .= '<th>ID:</th>';
        $tabela .= '<th>Nome:</th>';
        $tabela .= '<th>Preço:</th>';
        $tabela .= '</tr>';

        foreach ($dados as $row) :
            $tabela .= '<tr>';
            $tabela .= '<td id="idTabela" value="' . $row[0] . '">' . $row[0] . '</td>';
            $tabela .= '<td id="nomeTabela" value="' . $row[0] . '">' . $row[1] . '</td>';
            $tabela .= '<td>' . $row[2] . '</td>';
            $tabela .= '<td><input type="submit" id="editarTabela" data-action="' . $row[0] . '" value="Editar" href="#resultado"> </td>';
            $tabela .= '</tr>';
        endforeach;


        $tabela .= '</table>';

        return $tabela;
    }
}
function auxExibirTabela()
{
    $controller = new ContruirTabela();
    return $controller->montaTabela();
}
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

if (isset($_POST['id'])) { //verificando se o id não está vazio 
    require 'model.php';
    $id = $_POST['id'];
    $dadosID = consultarTabelaPorId('produtos', $id);
    echo json_encode($dadosID);
}
if (isset($_POST['update'])) { //verificando se o id não está vazio 
    //definindo a variavel $id utilizando get pois o id é passado na url
    if (!empty($_POST['nome']) && !empty($_POST['preco']) && (isset($_POST['id']))) {
        $id = $_POST['id'];
        $nomeI = $_POST['nome'];
        $precoI = $_POST['preco'];
        editarTabela('produtos', $nomeI, $precoI, $id);
        return;
    }
}
