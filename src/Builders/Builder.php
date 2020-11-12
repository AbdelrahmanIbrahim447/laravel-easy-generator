<?php


namespace biscuit\easyGenerator\Builders;


abstract class Builder
{
    abstract public static function build($content,$collection);
}