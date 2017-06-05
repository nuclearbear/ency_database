<?php

namespace Nuclearbear\Encydb\Encryption;

class Encrypting
{
    protected static function getSecuredNumber(integer $number): string
    {
        if ( !function_exists('random_bytes') ) {
            require_once "/path/to/random_compact.phar";
        }

        return random_bytes($number);
    }

    public static function encryptString(string $rawString, string $key): string
    {
        $nonce = self::getSecuredNumber(24);
        $ciphertext = sodium_crypto_secretbox($rawString, $nonce, $key);
        
        return bin2hex($nonce . $ciphertext);
    }

    public static function decryptString(string $encryptedString, string $key): string
    {
        $decoded = hex2bin($encryptedString);
        $nonce = mb_substr($decoded, 0, 24, '8bit');
        $cipher = mb_substr($decoded, 24, null, '8bit');

        return sodium_crypto_secretbox_open($cipher, $nonce, $key);
    }
}