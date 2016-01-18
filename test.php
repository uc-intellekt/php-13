<?php

$text = 'text'; // string
$a = 5.7; // float
$b = 7; // integer
$bool = true; // boolean
$arr = [1,2,3]; // array
// object
// resource

$c = $a * $b;

$int = (int)'123.45';
// echo $int;

// var_dump($text);

$arr = [
    'one' => 1,
    'two' => 2,
    'three' => 3,
];

// var_dump($arr);
// echo $arr['two'];

$serverLangs = [
    'php',
    'python',
    'ruby',
];
$clientLangs = [
    'JavaScript',
];

$langs = [
    'server' => $serverLangs,
    'client' => $clientLangs,
];
// var_dump($langs);

$countLangs = count($langs['server']);
for ($i = 0; $i < $countLangs; $i++) { // $i++ === $i = $i + 1
    // echo $langs['server'][$i];
}

echo '<ul class="list">'."\n";
foreach ($langs as $groupName => $langGroup) {
    foreach ($langGroup as $lang) {
        // echo '<li>';
        // echo $lang;
        // echo '</li>';
        // echo '<li>' . $lang . '</li>';
        echo "\t<li>{$lang}</li>\n";
    }
}
echo '</ul>';
