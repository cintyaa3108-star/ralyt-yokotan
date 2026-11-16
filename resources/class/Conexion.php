<?php
declare(strict_types=1);

/** Conexión a la base de datos (una sola instancia PDO para toda la aplicación). */
class Conexion
{
    // ===== CONFIGURACIÓN (ajústala si tu XAMPP usa otros datos) =====
    private const HOST = 'localhost';
    private const BD   = 'ralyt';
    private const USER = 'root';
    private const PASS = '';

    private static ?PDO $pdo = null;

    public static function get(): PDO
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::BD . ';charset=utf8mb4', self::USER, self::PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                http_response_code(500);
                exit('No se pudo conectar a la base de datos "ralyt". Revisa resources/class/Conexion.php y que hayas importado ralyt.sql y ralyt_ajustes.sql.');
            }
        }
        return self::$pdo;
    }
}
