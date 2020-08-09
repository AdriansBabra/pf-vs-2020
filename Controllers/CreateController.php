<?php

class CreateController extends Controller
{
    public static function Show()
    {
        self::CreateView('create', []);
    }

    public static function Create()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $data = [
            'title' => $title,
            'description' => $description
        ];

        self::query("INSERT INTO data (title, description) VALUES (:title, :description)", $data);
        $_SESSION['message'] = ['text' => 'Darāmā lieta tika izveidota!', 'type' => 'success'];
        header('Location: ' . './home');
        exit();
    }
}

?>