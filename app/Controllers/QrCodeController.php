<?php

namespace App\Controllers;

use App\Controllers\Controller;

class QrCodeController extends Controller
{

    public function qrcodes()
    {
        return $this->view('qrcodes');
    }

    public function store()
    {
        if (isset($_POST['content']) && !empty($_POST['content'])) {
            $content = $_POST['content'];
            $result = $this->qrcodeModel->saveQRCode($content);
            if ($result['success']) {
                return json_encode($result);
            }
            return json_encode($result);
        }
        return json_encode(["success" => false, "error" => "La URL es requerida."]);
    }

    public function select()
    {
        header('Content-Type: application/json');
        $result = $this->qrcodeModel->getQrCodes();
        if (!$result['success']) {
            return json_encode($result);
        }
        return json_encode($result['qrcodes']);
    }
}
