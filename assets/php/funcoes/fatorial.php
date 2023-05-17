<?php
function fatorial($number)
{
    $fatorial = 1;
    for ($i = 1; $i <= $number; $i++) {
        $fatorial *= $i;
    }
    return $fatorial;
}
