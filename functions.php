<?php

$text = 'qqq';

function hello($name = 'Guest', $count = null)
{
//    global $text;

    if ($count === null) {
        $count = rand(1, 10);
    }

    $o = str_repeat('o', $count);
    $message = "Hell{$o} {$name}!";

    return $message;

    echo 'never will be executed';
}

$message = hello('Victor', 5);
echo $message;

echo hello();
