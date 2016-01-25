<?php

class User
{
    private $name = 'Guest';

    public $surname;

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function hello($count = null)
    {
        if ($count === null) {
            $count = rand(1, 10);
        }

        $o = str_repeat('o', $count);
        $message = "Hell{$o} {$this->getFullName()}!";

        return $message;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}

$user = new User();
// var_dump($user);

$user->setName('Victor');
echo $user->getName();
// $user->surname = 'Surname';
// // echo $user->getFullName();
// echo $user->hello();
