<?php

namespace App\Controllers;

use App\Controllers\Controller;

class QrCodeController extends Controller
{

    public function qrcodes()
    {
        return $this->view('qrcodes');
    }

    public function store($request) {}
}
