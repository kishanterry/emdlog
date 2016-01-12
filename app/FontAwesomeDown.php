<?php
namespace App;

class FontAwesomeDown
{
    public static function parse($text)
    {
        return preg_replace('/:fa-([a-z-0-9].+?):/', '<i class="fa fa-${1}"></i>', $text);
    }
}