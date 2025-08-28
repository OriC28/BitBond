<?php

namespace App\Controllers;


# http://localhost/BitBond/caa7fa

class RedirectController extends Controller
{
    public function handleRedirect(string $code)
    {
        if (isset($code) && !empty($code)) {
            $result = $this->urlModel->getUrlByShortCode($code);
            if ($result) {
                header('Location: ' . $result['long_url']);
                exit();
            }
        }
        return false;
    }
}
