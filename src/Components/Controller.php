<?php


namespace Project\Components;


abstract class Controller
{
    public function view(string $name, array $data = []): ?string
    {
        //Izveidos jaunu view klasi, saliks datus, izvadís atgriezís skatu

        return (new View($name, $data))->render();
    }

    public function redirect(string $path)
    {
        header("Location: $path");

        return null;
    }
}