<?php

namespace App\Utils;

class Validator
{
    public static function validateUrl(string $url): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($url)) {

            if (filter_var($url, FILTER_VALIDATE_URL)) {
                return true;
            }
        }
        return false;
    }

    public static function validateContent(string $content)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($content)) {
            if (filter_var($content, FILTER_VALIDATE_URL) || preg_match("/^[a-zA-Z0-9:;._#áéíóúüñÁÉÍÓÚÑÜ\s\-]+$/u", $content)) {
                return true;
            }
        }
        return false;
    }
}
