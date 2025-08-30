<?php



namespace App\Controllers;

use App\Models\UrlModel;
use App\Models\QrCodeModel;

class Controller
{
    protected $urlModel;
    protected $qrcodeModel;

    public function __construct()
    {
        $this->urlModel = new UrlModel();
        $this->qrcodeModel = new QrCodeModel();
    }

    public function view(string $route, array $data = [])
    {
        extract($data);
        $route = str_replace('.', '/', $route);
        $path = "../app/Views/$route.php";
        if (file_exists($path)) {
            ob_start();
            include $path;
            $content = ob_get_clean();
            return $content;
        } else {
            http_response_code(404);
            die("Página no encontrada.");
        }
    }
}
