<?php

// 10 mins while remembering how to use regex, never was very good at this but I defend myself
function cypherString($str)
{
    $patterns = array(
        4 => '/[Aa]/',
        3 => '/[Ee]/',
        1 => '/[Ii]/',
        0 => '/[Oo]/',
        8 => '/[Bb]/',
        6 => '/[Ss]/'
    );

    return preg_replace(array_values($patterns), array_keys($patterns), $str);
}

echo cypherString('Ricard').PHP_EOL;
echo cypherString('Javi').PHP_EOL;
echo cypherString('Holaluz is a great place to work').PHP_EOL;
echo cypherString('This exercise is a bit quirky!').PHP_EOL;
echo cypherString('AEIOBSzzzzaeiobszzzz!').PHP_EOL;
