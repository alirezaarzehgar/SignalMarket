<?php

class Hashing
{
    public static function encrypt(string $password)
    {
        return md5($password);
    }
}
