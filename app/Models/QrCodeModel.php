<?php

namespace App\Models;

use App\Core\Database;
use App\Utils\Creator;
use App\Utils\Decoder;
use Exception;
use PDO;

class QrCodeModel
{
    private $connObject;

    public function __construct()
    {
        $this->connObject = new Database();
    }

    public function saveQRCode(string $content)
    {
        try {
            $data = Creator::createImageQR($content);
            if (!$data) {
                throw new Exception("Error al crear la imagen QR.");
            }
            $conn = $this->connObject->connect();
            $stmt = $conn->prepare("INSERT INTO qr_codes (text, image, created_at) VALUES (:content, :file_name, NOW());");
            $stmt->bindParam(':content', $data[0], PDO::PARAM_STR);
            $stmt->bindParam(':file_name', $data[1], PDO::PARAM_LOB);
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar el código QR.");
            }
            return [
                "success" => true,
                "content" => $data[0],
                "file_name" => $data[2]
            ];
        } catch (\Throwable $th) {
            return [
                "success" => false,
                "error" => "No se pudo guardar el código QR.",
                "debug" => $th->getMessage()
            ];
        } finally {
            $this->connObject->close();
        }
    }

    public function getQrCodes()
    {
        try {
            $conn = $this->connObject->connect();
            $stmt = $conn->prepare("SELECT * FROM qr_codes;");
            if (!$stmt->execute()) {
                throw new Exception("Error al obtener todos los códigos QR.");
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['success' => true, 'qrcodes' => Decoder::blobToBase64($result)];
        } catch (\Throwable $th) {
            return [
                "success" => false,
                "error" => "No se pudo obtener los códigos QR.",
                "debug" => $th->getMessage()
            ];
        } finally {
            $this->connObject->close();
        }
    }
}
