<?php

class Foo {
    public string $bar;
}

$foo = new Foo();
    $foo->bar = 'Hello World';

echo $foo->bar;