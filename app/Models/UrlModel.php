<?php

namespace App\Models;

use App\Core\Database;
use App\Utils\Creator;
use App\Utils\Validator;
use Exception;
use PDO;

class UrlModel
{
    private static $connObject;

    public function __construct()
    {
        self::$connObject = new Database();
    }

    public static function getShortCode(string $shortCode)
    {
        try {
            $conn = self::$connObject->connect();
            $stmt = $conn->prepare("SELECT 1 FROM urls WHERE short_code = :shortCode LIMIT 1");
            $stmt->bindParam(":shortCode", $shortCode);
            $stmt->execute();
            return $stmt->fetch() !== false;
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), true);
        }
    }

    public function storeUrl(string $url)
    {
        try {

            if (!Validator::validateUrl($url)) {
                return throw new Exception("La URL no es válida.");
            }

            $shortCode = Creator::createShortCode($url);
            $shortUrl = Creator::createShortUrl($shortCode);
            $conn = self::$connObject->connect();

            $stmt = $conn->prepare("INSERT INTO urls (long_url, short_url, short_code, created_at) VALUES (:long_url, :short_url, :short_code, NOW())");
            $stmt->bindParam(':long_url', $url, PDO::PARAM_STR);
            $stmt->bindParam(':short_url', $shortUrl, PDO::PARAM_STR);
            $stmt->bindParam(':short_code', $shortCode, PDO::PARAM_STR);
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar la URL.");
            }
            return [
                "success" => true,
                "long_url" => $url,
                "short_url" => $shortUrl,
                "short_code" => $shortCode
            ];
        } catch (\Throwable $th) {
            return [
                "success" => false,
                "error" => "No se pudo procesar la URL",
                "debug" => $th->getMessage()
            ];
        } finally {
            self::$connObject->close();
        }
    }

    public function getUrlByShortCode(string $shortCode)
    {
        try {
            $db = self::$connObject->connect();
            $stmt = $db->prepare("SELECT * FROM urls WHERE short_code = :code;");
            $stmt->bindParam(":code", $shortCode);
            if (!$stmt->execute()) {
                throw new Exception("Error al obtener la URL asociada al código $shortCode.");
            }
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return ['success' => true, 'url' => $result['long_url']];
        } catch (\Throwable $th) {
            return [
                "success" => false,
                "error" => "No se pudo obtener la url.",
                "debug" => $th->getMessage()
            ];
        } finally {
            self::$connObject->close();
        }
    }

    public function getUrls()
    {
        try {
            $db = self::$connObject->connect();
            $stmt = $db->prepare("SELECT * FROM urls;");
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar la URL.");
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['success' => true, 'urls' => $result];
        } catch (\Throwable $th) {
            return [
                "success" => false,
                "error" => "No se pudo obtener las urls.",
                "debug" => $th->getMessage()
            ];
        } finally {
            self::$connObject->close();
        }
    }
}
