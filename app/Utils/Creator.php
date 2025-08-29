<?php

namespace App\Utils;

use App\Models\UrlModel;
use QRcode;

class Creator
{
    public static function createShortUrl(string $shortCode)
    {
        $baseUrl = "http://" . $_SERVER["HTTP_HOST"] . "/BitBond/";
        $shortUrl = $baseUrl . $shortCode;
        return $shortUrl;
    }

    public static function createShortCode(string $url)
    {
        $shortCode = substr(md5($url . time()), 0, 6);
        while (urlModel::getShortCode($shortCode)) {
            $shortCode = substr(md5($url . time()), 0, 6);
        }
        return $shortCode;
    }

    public static function createImageQR(string $content)
    {
        if (Validator::validateContent($content)) {
            $file_name = "qr/" . uniqid() . ".png";
            QRcode::png($content, $file_name, QR_ECLEVEL_L, 10);
            $binaryImage = file_get_contents($file_name);
            return [$content, $binaryImage, $file_name];
        }
        return false;
    }
}
