<?php

namespace App\Models;

use App\Core\Database;
use App\Utils\Creator;
use Exception;
use PDO;

class QrCodeModel
{
    private $connObject;

    public function __construct()
    {
        $this->connObject = new Database();
    }

    public function saveQRCode($content)
    {
        try {
            $data = Creator::createImageQR($content);
            if ($data) {
                $conn = $this->connObject->connect();
                $stmt = $conn->prepare("INSERT INTO qr_codes (text, image, created_at) VALUES (?, ?, NOW());");
                $stmt->bindParam(1, $data[0]);
                $stmt->bindParam(2, $data[1], PDO::PARAM_LOB);
                $stmt->execute();
                $response = [
                    "status" => "success",
                    "content" => $data[0],
                    "file_name" => $data[2]
                ];
                return $response ? $response : null;
            }
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), true);
        } finally {
            $this->connObject->close();
        }
    }
}
