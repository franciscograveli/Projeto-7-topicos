<?php
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
