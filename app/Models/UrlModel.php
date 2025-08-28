<?php

namespace App\Models;

use App\Core\Database;
use App\Utils\Creator;
use App\Utils\Validator;
use Exception;
use PDO;

class UrlModel
{
    private $connObject;

    public function __construct()
    {
        $this->connObject = new Database();
    }

    public static function getShortCode(string $shortCode)
    {
        try {
            $conn = self::$connObject->connect();
            $stmt = $conn->prepare("SELECT * FROM urls WHERE short_code = :shortCode");
            $stmt->bindParam(":shortCode", $shortCode);
            $stmt->execute();
            if (count($stmt->fetchAll(PDO::FETCH_ASSOC)) == 0) {
                return false;
            }
            return true;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), true);
        }
    }

    public function storeUrl(string $url)
    {
        try {
            if (Validator::validateUrl($url)) {
                $shortCode = Creator::createShortCode($url);
                $shortUrl = Creator::createShortUrl($shortCode);
            }

            if ($shortCode) {
                $conn = $this->connObject->connect();
                $stmt = $conn->prepare("INSERT INTO urls (long_url, short_url, short_code, created_at) VALUES (?, ?, ?, NOW())");
                $stmt->bindParam(1, $url);
                $stmt->bindParam(2, $shortUrl);
                $stmt->bindParam(3, $shortCode);
                $stmt->execute();
                $this->connObject->close();
                return [
                    "long_url" => $url,
                    "short_url" => $shortUrl,
                    "short_code" => $shortCode
                ];
            }
        } catch (\Throwable $th) {
            return [
                "error" => $th->getMessage()
            ];
        }
    }

    public function getUrlByShortCode(string $shortCode)
    {
        try {
            $db = $this->connObject->connect();
            $stmt = $db->prepare("SELECT * FROM urls WHERE short_code = :code;");
            $stmt->bindParam(":code", $shortCode);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->connObject->close();
            return $result ? $result : null;
        } catch (\Throwable $th) {
            throw new Exception("Error al obtener la URL: " . $th->getMessage(), 1);
        }
    }

    public function getUrls()
    {
        try {
            $db = $this->connObject->connect();
            $stmt = $db->prepare("SELECT * FROM urls;");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->connObject->close();
            return $result ? $result : false;
        } catch (\Throwable $th) {
            throw new Exception("Error al obtener las URLs: " . $th->getMessage(), 1);
        }
    }
}
