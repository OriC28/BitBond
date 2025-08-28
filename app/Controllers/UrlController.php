<?php

namespace App\Controllers;

use App\Controllers\Controller;

class UrlController extends Controller
{

    public function links()
    {
        return $this->view('links');
    }

    public function store(string $url)
    {
        if (isset($url) && !empty($url)) {
            $result = $this->urlModel->storeUrl($url);
            if ($result) {
                return json_encode($result);
            }
        }
        return json_encode(['error' => true]);
    }
}
