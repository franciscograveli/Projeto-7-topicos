<!-- Lista topicos gerais: -->
<!-- 
1. Crie uma página PHP que exiba a data atual e a hora atual formatada de acordo com o padrão "dd/mm/aaaa hh:mm:ss".
2. Crie um formulário HTML com os campos "nome", "e-mail" e "mensagem". Ao enviar o formulário, exiba a mensagem "Obrigado por entrar em contato, [nome]!" na mesma página PHP, onde [nome] é o valor digitado no campo "nome".
3. Crie uma função em PHP que receba como parâmetro um número inteiro e retorne o seu fatorial.
4. Conecte-se a um banco de dados MySQL em PHP e crie uma tabela chamada "produtos" com os campos "id" (inteiro, auto incrementado), "nome" (texto) e "preco" (decimal). Insira alguns registros na tabela.
5. Crie uma página PHP que liste todos os produtos da tabela "produtos" em uma tabela HTML. Adicione um link "Editar" ao lado de cada produto, que leva a uma página PHP de edição do produto correspondente.
6. Crie uma página PHP de edição de produto que permita editar o nome e o preço do produto selecionado. Ao enviar o formulário, atualize o registro correspondente na tabela "produtos" e exiba a mensagem "Produto atualizado com sucesso!".
7. Crie uma classe em PHP chamada "Calculadora" que tenha métodos para somar, subtrair, multiplicar e dividir dois números. Teste a classe em um arquivo PHP separado. 
-->


<!--  -->
<?php //PHP - form com envio de email via PHPMailer(2)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ((isset($_POST['nome'])) || (isset($_POST['email']))) {
    if (strlen($_POST['nome']) < 2) {
        echo
        "
        <script>
        alert('Preencha seu nome');
        document.location.href = '/index.php';
        </script>
        ";
    } else if (strlen($_POST['email']) < 2) {
        echo
        "
        <script>
        alert('Preencha seu Email');
        document.location.href = '/index.php';
        </script>
        ";
    } else if (strlen($_POST['msg']) == 0) {
        echo
        "
        <script>
        alert('Preencha seu Mensagem');
        document.location.href = '/index.php';
        </script>
        ";
    } else {

        require 'assets/PHPMailer-master/src/Exception.php';
        require 'assets/PHPMailer-master/src/PHPMailer.php';
        require 'assets/PHPMailer-master/src/SMTP.php';
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'junior.js87@gmail.com';
        $mail->Password = 'xiccbkvhskwrtqds';
        $mail->Port = 587;

        $mail->setFrom('junior.js87@gmail.com');

        $mail->addAddress($_POST['email']);

        $mail->isHTML(true);

        $mail->Subject = "!Assunto!";

        $mail->Body = $_POST['msg'];

        $mail->send();
        if (!$mail->send()) {
            echo
            "
            <script>
            alert('Não foi possível enviar a mensagem.<br> Erro:" . "$mail->ErrorInfo');
            document.location.href = '/index.php';
            </script>
            ";
        } else {
            echo
            "
            <script>
            alert('Obrigado por entrar em contato, " . "$_POST[nome]!');
            document.location.href = '/index.php'
            </script>
            ";
        }
    }
}

?>
<!--  -->
<?php //PHP - Função Fatorial:(3)
$resultadoF = 1;
$aux = 0;
function fatorial($n)
{
    $fatorial = $n;
    if (($n >= 0) && ($n < 2)) {
        return 1;
    } else if ($n >= 2) {
        do {
            $fatorial = $fatorial * ($n - 1);
            $n = $n - 1;
        } while ($n >= 2);

        return ($fatorial);
    } else {
        return "!Inválido!";
    }
}
if (isset($_POST['fatorial'])) {
    $aux = (int)($_POST['fatorial']);
    $resultadoF = fatorial((int)($_POST['fatorial']));
}
?>
<!--  -->
<?php //PHP - Conectar ao Banco(4)

$host = "localhost";
$login = "root";
$senha = "";
$nomebd = "bd-7-em-1";

$mysqli = new mysqli($host, $login, $senha, $nomebd);

if ($mysqli->error) {
    die("Erro de Conexão:" . $mysqli->error);
}

$retorno = $mysqli->query("SELECT * FROM produtos");

?>
<!--  -->
<?php //PHP - Exibir Tabela produtos e Editar ((5)&&(6))
$nomeProduto = '';
$precoProduto = '';

if ($retorno->num_rows > 0) {
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
    if (!empty($_GET['id'])) {
?>
        <!--  Fazer Resultado só aparecer quando quiserem editar: -->
        <style>
            .areaResult {
                display: flex;
                visibility: visible;
            }
        </style>
<?php
        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM produtos WHERE id=$id";

        $resultadoById = $mysqli->query($sqlSelect);

        if ($resultadoById->num_rows > 0) {

            while ($produto = $resultadoById->fetch_assoc()) {
                $nomeProduto = $produto['nome'];
                $precoProduto = $produto['preco'];

                if (isset($_POST['update'])) {
                    if ((!empty($_POST['nomeItem'])) && (!empty($_POST['precoItem']))) {

                        $sqlEdit = "UPDATE produtos SET nome='$_POST[nomeItem]', preco='$_POST[precoItem]' WHERE id='$id'";

                        $mysqli->query($sqlEdit);

                        if ($mysqli->query($sqlEdit) === TRUE) {
                            echo
                            "
                            <script>
                            alert('Atualizado com Sucesso!" . "$_POST[nome]!');
                            document.location.href = '/index.php'
                            </script>
                            ";
                        } else {
                            echo
                            "
                            <script>
                            alert('Atualizado com Sucesso!" . "$mysqli->error!');
                            document.location.href = '/index.php'
                            </script>
                            ";
                        }
                    }
                }
            }
        } else {
            echo
            "
            <script>
            alert('Numero de Rows <= 0');
            document.location.href = '/index.php'
            </script>
            ";
        }
    }
}

?>
<!--  -->
<?php //Class para a calculadora - (7)
class calculadora
{
    public function soma($a, $b)
    {
        $total = $a + $b;
        return number_format($total, 2);
    }
    public function sub($a, $b)
    {
        $total = $a - $b;
        return number_format($total, 2);
    }
    public function mult($a, $b)
    {
        $total = $a * $b;
        return number_format($total, 2);
    }
    public function div($a, $b)
    {
        if ($b != 0) {
            $total = $a / $b;
            return number_format($total, 2);
        } else {
            return "Null :(";
        }
    }
}
?>
<!--  -->
<?php //PHP Calculadora - (7)

$calc = 0;
if ((isset($_POST['a'])) && (isset($_POST['b']))) {
    $a = $_POST['a'];
    $b = $_POST['b'];
    if (isset($_POST['soma'])) {
        $calc = new calculadora();
        $calc = $calc->soma($a, $b);
    } else if (isset($_POST['sub'])) {
        $calc = new calculadora();
        $calc = $calc->sub($a, $b);
    } else if (isset($_POST['mult'])) {
        $calc = new calculadora();
        $calc = $calc->mult($a, $b);
    } else if (isset($_POST['div'])) {
        $calc = new calculadora();
        $calc = $calc->div($a, $b);
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>PHP-7-em-1</title>
</head>

<body>
    <nav>
        <div class="mostrahora" id="mostrahora1">

            <?php //PHP - Data e Hora (1)
            date_default_timezone_set('America/Sao_Paulo');

            $data = getdate();
            print_r($data['hours'] . ':' . $data['minutes'] . ':' . $data['seconds']);
            echo "<br>";
            print_r($data['weekday'] . ', ' . $data['mday'] . ' de ' . $data['month'] . ' de ' . $data['year']);

            ?>

        </div>
        <div class="mostrahora" id="mostrahora2">
            <?php
            $data2 = new DateTime();
            echo $data2->format('H:i:s');
            echo "<br>";
            echo $data2->format('d/m/Y H:i:s');

            ?>
        </div>
        <div class="mostrahora" id="mostrahora3">
            <?php

            echo "Unix : " . strtotime("now") . 's';

            ?>
        </div>
    </nav>
    <section>
        <div class="container">
            <!-- HTML - Form (2) -->
            <div class="areaMsg">
                <form action="" method="POST">
                    <input type="text" name="nome" id="" placeholder="Nome:">
                    <input type="email" name="email" id="" placeholder="E-mail:">
                    <textarea id="msg" name="msg" rows="4" cols="50" placeholder="Mensagem:"></textarea>
                    <input type="submit" value="Enviar">
                </form>
            </div>
            <!--  -->
            <div class="areaCalc">
                <form action="" method="POST" id="calc">
                    <input readonly type="text" name="" id="" min="0" placeholder='<?php echo $calc; ?>' class="result" style="cursor:default; text-align:center; font-size:1rem; color:var(--escuro); font-weight:500; width:100px; height: 100px; border-radius: 100px; box-shadow: 0 0 10px var(--escuro);">
                    <input type="number" name="a" id="" step="any" placeholder="A:" value="0">
                    <input type="number" name="b" id="" step="any" placeholder="B:" value="0">
                    <div class="Calbtns">
                        <input type="submit" value="" name="soma" id="soma">
                        <input type="submit" value="" name="sub" id="subtrai">
                        <input type="submit" value="" name="mult">
                        <input type="submit" value="" name="div">
                    </div>
                </form>
            </div>
            <!--  -->
            <div class="areaFat">
                <form action="" method="POST">
                    <input readonly type="text" name="" id="" min="0" placeholder='<?php echo $resultadoF; ?>' style="cursor:default; text-align:center; font-size:1rem; color:var(--escuro); font-weight:500; width:100px; height: 100px; border-radius: 100px; box-shadow: 0 0 10px var(--escuro);">
                    <input type="number" name="fatorial" id="" min="0" placeholder='<?php echo $aux .  "!"; ?>'>
                    <input type="submit" value="Calcular">
                </form>
            </div>

        </div>
    </section>
    <div class="areaResult" id="resultado">
        <form action="" method="POST">
            <input type="text" name="nomeItem" id="" placeholder="Nome:" value="<?php echo $nomeProduto ?>">
            <input type="number" step="any" min="0" name="precoItem" id="" placeholder="Preço:" value="<?php echo $precoProduto ?>">
            <input type="submit" name="update" value="Enviar">
        </form>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>