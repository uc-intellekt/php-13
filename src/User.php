<?php

if (!defined('SECURITY')) {
    die('Direct access restricted!');
}

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
