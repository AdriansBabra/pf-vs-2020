<?php
require_once 'vendor/autoload.php';

use PF\Cat;
use PF\Dog;

$muris = new Dog('Muris');
$reksis = new Cat('Reksis');
$muris->sleep();
$muris->sleep();
$muris->sleep();
$muris->sleep();
$reksis->run();
$reksis->run();
$muris->run();
var_dump($reksis);
var_dump($muris);

var_Dump(Dog::$animalCount);

class A{
    public static string $foo = 'a';
    public static function foo(): string
    {
        return static::$foo;
    }
}
class B extends A
{
    public static string $foo = 'b';
}
class C extends A
{
    public static string  $foo = 'c';
}
var_dump(B::foo());
var_dump(C::foo());



