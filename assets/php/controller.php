<?php //PHP - form com envio de email via PHPMailer(2)
if ((isset($_POST['nome'])) || (isset($_POST['email']))) { //verificando se o nome ou email está bem definido
    if (strlen($_POST['nome']) == 0) { // verificando se por quantidade de caracteres o nome é valido
        echo
        "
        <script>
        alert('Preencha seu nome');
        document.location.href = '/index.php';
        </script>
        ";
    } else if (strlen($_POST['email']) < 2) { // verificando se por quantidade de caracteres o email é valido
        echo
        "
        <script>
        alert('Preencha seu Email');
        document.location.href = '/index.php';
        </script>
        ";
    } else if (strlen($_POST['msg']) == 0) { // verificando se por quantidade de caracteres a mensagem é valida
        echo
        "
        <script>
        alert('Preencha seu Mensagem');
        document.location.href = '/index.php';
        </script>
        ";
    } else { // se passar por todas verificações, começa a preparar a validação para envio do email
        require '../php/funcoes/enviaremail.php';

        $nomeMsg = ucwords(strtolower($_POST['nome'])); // pega o nome inteiro e ajusta padroniza começando com a primeira letra maiuscula em cada palavra
        $primeiroNome = strtok($nomeMsg, " "); //pegando o primeiro nome
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // "removendo" os caracteres especiais do email para verificar se o formato é valido

        enviarEmail($primeiroNome, $email, $_POST['msg']);
    }
}

//PHP - Função Fatorial:(3)
if (isset($_POST['fatorial'])) { //verificando se o input fatorial está definido
    require '../php/funcoes/fatorial.php';
    $aux = (int)($_POST['fatorial']); // definindo uma variavel auxiliar para manter o input fatorial com o valor que a pessoa está utilizando para a conta
    $_POST['resultFat'] = fatorial((int)($_POST['fatorial'])); // definindo o resultado fatorial por meio da funcão fatorial criada anteriormente | Utilizando a função int pois fatorial só está definido para os naturais
    require_once '../../index.php';
}

//

//PHP Calculadora - (7)
if ((isset($_POST['a'])) && (isset($_POST['b']))) {
    require '../php/funcoes/calculadora.php';
    $a = $_POST['a'];
    $b = $_POST['b'];
    $calc = new calculadora();
    if (isset($_POST['soma'])) {
        $calc = $calc->soma($a, $b);
    } else if (isset($_POST['sub'])) {
        $calc = $calc->sub($a, $b);
    } else if (isset($_POST['mult'])) {
        $calc = $calc->mult($a, $b);
    } else if (isset($_POST['div'])) {
        $calc = $calc->div($a, $b);
    }
    require_once '../../index.php';
}

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

?>
<!--  -->