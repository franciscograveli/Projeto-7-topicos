<?php
class calculadora
{
    public function soma($a, $b)
    {
        $total =  $a + $b;
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
            return "Indefinido :(";
        }
    }
}
