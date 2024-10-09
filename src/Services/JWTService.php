<?php

namespace src\Services;

require __DIR__ . '/../../vendor/autoload.php';

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService
{
    private $role;
    private $key;
    private $payload;

    public function __construct()
    {

        $this->role = $_SESSION['user']->getRoleUser();

        $this->key = KEY_PAYLOAD;

        $this->payload = [
            "iat" => time(),
            "exp" => time() + 60 * 60,
            "role" => $this->role,
        ];
    }

    public function encodeToken(): string
    {
        return JWT::encode($this->payload, $this->key, 'HS256');
    }

    public function checkTokenAdmin(string $token): string
    {
        try {
            $decode = JWT::decode($token, new Key($this->key, "HS256"));
            if ($decode->role == "Admin") {
                return True;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return False;
        }
    }

    public function checkTokenUser(string $token): string
    {
        try {
            $decode = JWT::decode($token, new Key($this->key, "HS256"));
            if ($decode->role == "User") {
                return True;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return False;
        }
    }
}
