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
    'PHP',
    'Python',
];
$serverLangs[] = 'JavaScript';
unset($serverLangs[3]);
// var_dump($serverLangs); die();

$clientLangs = [
    'JavaScript',
];

$langs = [
    'server' => $serverLangs,
    'client' => $clientLangs,
];
$langs['server'][] = 'Ruby';
// var_dump($langs);
// print_r($langs);
// die;

$countLangs = count($langs['server']);
for ($i = 0; $i < $countLangs; $i++) { // $i++ === $i = $i + 1
    // echo $langs['server'][$i];
}

// echo '<ul class="list">'."\n";
// foreach ($langs as $groupName => $langGroup) {
//     foreach ($langGroup as $lang) {
//         // echo '<li>';
//         // echo $lang;
//         // echo '</li>';
//         // echo '<li>' . $lang . '</li>';
//         echo "\t<li>{$lang}</li>\n";
//     }
// }
// echo '</ul>';

// array_merge();
?>

<ul class="list">
    <?php foreach ($langs as $groupName => $langGroup) : ?>
        <?php foreach ($langGroup as $index => $lang) : ?>
            <li<?php if ($index % 2 == 0) : ?> style="background-color: #DDD;"<?php endif ?>><?php echo $lang ?></li>
        <?php endforeach ?>
    <?php endforeach ?>
</ul>
