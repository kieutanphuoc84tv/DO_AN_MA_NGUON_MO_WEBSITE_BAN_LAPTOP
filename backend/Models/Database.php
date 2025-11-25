<?php
declare(strict_types=1);

// Simple MySQL database connection helper
class Database
{
    private \PDO $connection;

    public function __construct(array $config)
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=utf8mb4',
            $config['DB_HOST'] ?? 'localhost',
            $config['DB_NAME'] ?? ''
        );
        $username = $config['DB_USER'] ?? 'root';
        $password = $config['DB_PASS'] ?? '';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->connection = new \PDO($dsn, $username, $password, $options);
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}


