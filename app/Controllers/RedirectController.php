<?php

namespace App\Controllers;


# http://localhost/BitBond/caa7fa

class RedirectController extends Controller
{
    public function handleRedirect(string $code)
    {
        if (isset($code) && !empty($code)) {
            $result = $this->urlModel->getUrlByShortCode($code);
            if ($result['success']) {
                header('Location: ' . $result['url']);
                exit();
            }
        }
        return json_encode($result);
    }
}
