<?php
for($i=0; $i<20; $i++)
{
    if(($i+1)%3 === 0 && ($i+1)%5 === 0)
        echo "FizzBuzz \n";
    elseif (($i+1)%3 === 0)
        echo "Fizz \n";
    elseif (($i+1)%5 === 0)
        echo "Buzz \n";
    else
        echo $i+1 . "\n";
}
