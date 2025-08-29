<?php

namespace App\Controllers;

use App\Controllers\Controller;

class UrlController extends Controller
{

    public function links()
    {
        return $this->view('links');
    }

    public function store()
    {

        if (isset($_POST['url']) && !empty($_POST['url'])) {
            $url = $_POST['url'];
            $result = $this->urlModel->storeUrl($url);
            if ($result['success']) {
                return json_encode($result);
            }
            return json_encode($result);
        }
        return json_encode(["success" => false, "error" => "La URL es requerida."]);
    }

    public function select()
    {
        $result = $this->urlModel->getUrls();
        if (!$result['success']) {
            return json_encode($result);
        }
        return json_encode($result);
    }
}
