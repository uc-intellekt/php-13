<?php

class Customer extends User
{
    public function __construct($name)
    {
//        $this->name = $name;
        parent::__construct($name);
    }
}
