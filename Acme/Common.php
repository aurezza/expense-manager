<?php

namespace Acme;

class Common
{
    public static function getRandomHexCode() 
    {
        $hex = '#'.str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);

        return $hex;
    }

}
