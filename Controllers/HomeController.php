<?php
class HomeController extends Controller
{

    public static function Show()
    {
        $data = self::query("SELECT * FROM data");
        self::CreateView('index', ['data' => $data]);
    }

    public static function Delete()
    {
        $url = self::getUrl();

        $id = substr($url, strrpos($url, '/') + 1);
        self::query("DELETE FROM data WHERE id=:id", ['id' => $id]);
        $_SESSION['message'] = ['text' => 'Darāmā lieta tika dzēsta!', 'type' => 'danger'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

?>