<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/assets/img/favicon_io/site.webmanifest">
    <title>PHP-7-em-1</title>
</head>

<body>
    <nav>

        <div class="mostrahora" id="mostrahora1">
            <p id="relogio1"></p>
        </div>
        <div class="mostrahora" id="mostrahora2">
            <p id="relogio2"></p>
        </div>
        <div class="mostrahora" id="mostrahora3">
            <p id="relogio3"></p>
        </div>
    </nav>
    <section>
        <div class="container">
            <!-- HTML - Form (2) -->
            <div class="areaMsg">
                <form action="" method="POST" id="msgForm">
                    <input type="text" name="nome" id="nome" placeholder="Nome:">
                    <input type="email" name="email" id="email" placeholder="E-mail:">
                    <textarea id="msg" name="msg" id="msg" rows="4" cols="50" placeholder="Mensagem:"></textarea>
                    <input type="submit" id="botaoMsg" value="Enviar">
                </form>
            </div>
            <!--  -->

            <div class="areaCalc">
                <form action="" method="POST" id="calcForm">
                    <input readonly type="text" name="resultCalc" id="resultCalc" value="">
                    <input type="number" name="a" id="a" step="any" placeholder="A:">
                    <input type="number" name="b" id="b" step="any" placeholder="B:">
                    <div class="CalBtns">
                        <input type="submit" value="" name="soma" data-action="somar" id="soma">
                        <input type="submit" value="" name="sub" data-action="subtrair" id="sub">
                        <input type="submit" value="" name="mult" data-action="multiplicar" id="mult">
                        <input type="submit" value="" name="div" data-action="dividir" id="div">
                    </div>
                </form>
            </div>
            <!--  -->
            <div class="areaFat">
                <form action="" method="POST" id="fatForm" class="teste">
                    <input readonly type="text" name="resultFat" id="resultFat" min="0" value="0">
                    <input type="number" name="fatorial" id="numberFat" min="0" placeholder='!'>
                    <input type="submit" value="Calcular">
                </form>

            </div>

        </div>
    </section>
    <div class=" areaResult" id="resultado">
        <form action="" method="POST" id="PTabela">
            <input type="text" name="nomeItem" id="nomeItem" placeholder="Nome:" value="">
            <input type="number" step="any" min="0" name="precoItem" id="precoItem" placeholder="Preço:" value="">
            <button type="submit" name="" id="update" value="">EDITAR</button>
        </form>
        <?php
        require_once './assets/php/controller.php';
        $controller = new ContruirTabela();
        echo $controller->montaTabela();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/jquery-3-7-0.js"></script>
    <script src="/assets/js/index.js"> </script>
</body>

</html>