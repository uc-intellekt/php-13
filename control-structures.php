<?php

$hours = date('H');
// $hours = 8; // debug

if ($hours <= 10) {
    echo 'Good morning!';
} elseif ($hours <= 15) {
    echo 'Good afternoon!';
} elseif ($hours <= 21) {
    echo 'Good evening!';
} else {
    echo 'Hello!!!';
}
