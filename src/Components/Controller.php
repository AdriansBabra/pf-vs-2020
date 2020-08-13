<?php


namespace Project\Components;


abstract class Controller
{
    public function view(string $name, array $data = []): string
    {
        //TODO: Izveidos jaunu view klasi, saliks datus, izvadís atgriezís skatu

        return (new View($name, $data))->render();
    }
}