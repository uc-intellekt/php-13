<?php

define('SECURITY', true);

//include '...';
require_once __DIR__ . '/src/RoleInterface.php';
require_once __DIR__ . '/src/HelloTrait.php';
require_once __DIR__ . '/src/User.php';
require_once __DIR__ . '/src/Customer.php';

//$user = new User();
// var_dump($user);

//$user->setName('Victor');
//echo $user->getName();
// $user->surname = 'Surname';
// // echo $user->getFullName();
// echo $user->hello();

//echo $user->getCount();
//echo User::getCount();

$customer = new Customer('Victor');
echo $customer;
