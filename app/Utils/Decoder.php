<?php

namespace App\Utils;


class Decoder
{
    public static function blobToBase64(array $data)
    {
        $mimeType = "image/png";
        foreach ($data as &$blobContent) {
            if (isset($blobContent['image'])) {
                $base64Content = base64_encode($blobContent['image']);
                $dataUri = 'data:' . $mimeType . ';base64,' . $base64Content;
                $blobContent['image'] = $dataUri;
            }
        }
        unset($blobContent);
        return $data;
    }
}
