<!DOCTYPE html>
<html lang="pr-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/assets/img/favicon_io/site.webmanifest">
    <title>PHP-7-em-1</title>
</head>

<body>
    <nav>
        <div class="mostrahora" id="mostrahora1">

            <?php //PHP - Data e Hora (1)
            $timeReload = true;
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
                <form action="/assets/php/controller.php" method="POST">
                    <input type="text" name="nome" id="" placeholder="Nome:">
                    <input type="email" name="email" id="" placeholder="E-mail:">
                    <textarea id="msg" name="msg" rows="4" cols="50" placeholder="Mensagem:"></textarea>
                    <input type="submit" value="Enviar">
                </form>
            </div>
            <!--  -->

            <div class="areaCalc">
                <form action="/assets/php/controller.php" method="POST" id="calc">
                    <input readonly type="text" name="resultCalc" id="" value="<?php if (!empty($calc)) : echo htmlspecialchars($calc);
                                                                                endif;  ?>" style="cursor:default; text-align:center; font-size:1rem; color:var(--escuro); font-weight:500; width: 35%; min-width:100px; height: 100px; border-radius: 100px; box-shadow: 0 0 10px var(--escuro);">
                    <input type="number" name="a" id="" step="any" placeholder="A:" value="0">
                    <input type="number" name="b" id="" step="any" placeholder="B:" value="0">
                    <div class="Calbtns">
                        <input type="submit" value="SOMA" name="soma" id="soma">
                        <input type="submit" value="SUBTRAÇÃO" name="sub" id="subtrai">
                        <input type="submit" value="MULTIPLICAÇÃO" name="mult">
                        <input type="submit" value="DIVISÃO" name="div">
                    </div>
                </form>
            </div>
            <!--  -->
            <div class="areaFat">
                <form action="/assets/php/controller.php" method="POST" id="fat">
                    <input readonly type="text" name="resultFat" id="" min="0" value="<?php if (!empty($_POST['resultFat'])) : echo htmlspecialchars($_POST['resultFat']);
                                                                                        endif; ?>" style="cursor:default; text-align:center; font-size:1rem; color:var(--escuro); font-weight:500; height: 100px; border-radius: 100px; box-shadow: 0 0 10px var(--escuro);">
                    <input type="number" name="fatorial" id="" min="0" placeholder='<?php if (!empty($_POST['fatorial'])) : echo htmlspecialchars($_POST['fatorial']);
                                                                                    endif; ?>!'>
                    <input type="submit" value="Calcular" id="fat">
                </form>
            </div>

        </div>
    </section>
    <div class="areaResult" id="resultado">
        <form action="/assets/php/controller.php" method="POST">
            <input type="text" name="nomeItem" id="" placeholder="Nome:" value="<?php if (!empty($nomeProduto)) : echo htmlspecialchars($nomeProduto);
                                                                                endif; ?>">
            <input type="number" step="any" min="0" name="precoItem" id="" placeholder="Preço:" value="<?php if (!empty($precoProduto)) : echo htmlspecialchars($precoProduto);
                                                                                                        endif; ?>">
            <input type="submit" name="update" value="Enviar">
        </form>
    </div>
</body>

</html>