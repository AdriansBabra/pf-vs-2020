<?php


namespace Project\Structures;


use Project\Interfaces\RpcResponseInterface;

class QuizStructure implements RpcResponseInterface
{
    public ?int $id = null;
    public ?int $questionCount = null;
    public ?string $name = null;

    public function toArray(): array
    {
        return (array)$this;
    }
}