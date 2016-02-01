<?php

trait HelloTrait
{
    public function hello($count = null)
    {
        if ($count === null) {
            $count = rand(1, 10);
        }

        $o = str_repeat('o', $count);
        $message = "Hell{$o} {$this->getFullName()}!";

        return $message;
    }
}
