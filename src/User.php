<?php

if (!defined('SECURITY')) {
    die('Direct access restricted!');
}

abstract class User implements RoleInterface
{
    use HelloTrait;

    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    private static $count = 0;

    protected $name;

    public $surname;

    private $role;

    public function __construct($name = 'Guest')
    {
        self::$count++; // self::$count = self::$count + 1;
        $this->setName($name);
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public static function getCount()
    {
        return self::$count;
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
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
