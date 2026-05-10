<?php
namespace App\Infrastructure\Persistence;

use App\Domain\User\UserRepository;
use PDO;

class MySQLUserRepository implements UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(array $user): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (email, password)
             VALUES (:email, :password)"
        );

        $stmt->execute([
            'email' => $user['email'],
            'password' => $user['password']
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * 
            FROM users 
            WHERE email = :email"
        );

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}