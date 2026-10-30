<?php

class AdminProfileModel
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findById(int $id): ?array
    {
        $statement = $this->pdo->prepare('SELECT id, name, email, password FROM admins WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $admin = $statement->fetch(PDO::FETCH_ASSOC);
        return $admin ?: null;
    }

    public function updateName(int $id, string $name): bool
    {
        $statement = $this->pdo->prepare('UPDATE admins SET name = :name, updated_at = CURRENT_TIMESTAMP WHERE id = :id');
        return $statement->execute(['name' => $name, 'id' => $id]);
    }

    public function updatePassword(int $id, string $passwordHash): bool
    {
        $statement = $this->pdo->prepare('UPDATE admins SET password = :password, updated_at = CURRENT_TIMESTAMP WHERE id = :id');
        return $statement->execute(['password' => $passwordHash, 'id' => $id]);
    }
}
