<?php


class EditController extends Controller {


    public static function Show()
    {
        $url = self::getUrl();
        $id = substr($url, strrpos($url, '/') + 1);
        $todo = self::query('SELECT * FROM data WHERE id = :id', ['id' => $id]);

        self::CreateView('edit', ['data' => $todo]);
    }

    public static function Edit()
    {
        $url = self::getUrl();
        $id = substr($url, strrpos($url, '/') + 1);
        $data = [
            'id' => $id,
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ];
        self::query('UPDATE data SET title = :title, description = :description WHERE id = :id', $data);
        $_SESSION['message'] = ['text' => 'Darāmā lieta tika rediģēta', 'type' => 'success'];
        header('Location: ' . './../home');
        exit();
    }
}
