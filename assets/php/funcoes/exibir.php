<?php
function exibirSeExistir($variavel)
{
    if (!empty($variavel)) {
        echo htmlspecialchars($variavel);
    } else if (empty($variavel)) {
        echo '';
    }
}
