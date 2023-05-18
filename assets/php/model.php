<?php //PHP - Conectar ao Banco(4)
//utilizando a biblioteca mysqli para conexão com o banco
function conectarBanco()
{

    $host = "localhost";
    $login = "root";
    $senha = "";
    $nomebd = "bd-7-em-1";

    $mysqli = new mysqli($host, $login, $senha, $nomebd);

    if ($mysqli->connect_error) {
        die("Erro de Conexão:" . $mysqli->connect_error);
    } else {
        return $mysqli;
    }
}

function consultarTabela($nomeTabela)
{
    $mysqli = conectarBanco();
    $resultadoTabela = $mysqli->query("SELECT * FROM $nomeTabela");
    $mysqli->close();
    return $resultadoTabela->fetch_all();
}
function consultarTabelaPorId($nomeTabela, $id)
{
    $mysqli = conectarBanco();
    $sqlSelect = "SELECT * FROM $nomeTabela WHERE id=$id";
    $resultadoTabela = $mysqli->query($sqlSelect);
    $mysqli->close();
    return $resultadoTabela->fetch_assoc();
}
function editarTabela($nomeTabela, $nomeItem, $precoItem, $id)
{

    $mysqli = conectarBanco();
    $sqlEdit = "UPDATE $nomeTabela SET nome='$nomeItem', preco='$precoItem' WHERE id='$id'"; //definindo codigo de alteração para o sql
    $mysqli->query($sqlEdit);
    $mysqli->close();
    return consultarTabela($nomeTabela);
}
