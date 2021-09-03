<?php

function fibonacci(int $n)
{
    if($n === 0)
        return 0;
    return $n<3 ? 1 : fibonacci($n - 1) + fibonacci($n - 2);
}

echo fibonacci(10) ."\n";
echo fibonacci(5) ."\n";
echo fibonacci(1) ."\n";
