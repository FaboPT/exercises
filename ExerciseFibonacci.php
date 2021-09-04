<?php

function fibonacci(int $n)
{
    return $n<2 ? $n : fibonacci($n - 1) + fibonacci($n - 2);
}

function fib(int $n){
    $j = 1;
    $i = 0;
    
    for($k=0;$k<$n; $k++){
        $t = $i+$j;
        $i = $j;
        $j = $t;
    }
    return $i;
}


echo fibonacci(10) ."\n";
echo fibonacci(5) ."\n";
echo fibonacci(1) ."\n";
echo fib(10) ."\n";
echo fib(5) ."\n";
echo fib(1) ."\n";
