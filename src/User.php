<?php

if (!defined('SECURITY')) {
    die('Direct access restricted!');
}

class User
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    private static $count = 0;

    private $name;

    public $surname;

    public function __construct($name = 'Guest')
    {
        self::$count++; // self::$count = self::$count + 1;
        $this->setName($name);
    }

    public static function getCount()
    {
        return self::$count;
    }

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
