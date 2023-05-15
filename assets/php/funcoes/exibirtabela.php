<?php
require 'conectarBD.php';
$mysqli = conectarBanco(); //PHP - Conectar ao Banco(4)

$retorno = $myslqli->query("SELECT * FROM produtos"); //retornando os dados da tabela produtos

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
                        <td id='botaoTabela'><a href='index.php?id=$row[id]#resultado'>Editar</a></td>
                    </tr>";
    }
}
