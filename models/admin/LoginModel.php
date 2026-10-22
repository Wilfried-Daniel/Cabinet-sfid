<?php

class LoginModel {
    private PDO $db;

    // Le constructeur reçoit l'objet $pdo de votre fichier bdd.php
    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    public function getAdminByEmail(string $email) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(); // FETCH_ASSOC est déjà défini par défaut dans votre bdd.php !
    }

    public function updateLastLogin(int $adminId) {
        $stmt = $this->db->prepare("UPDATE admins SET last_login_at = NOW() WHERE id = :id");
        $stmt->execute(['id' => $adminId]);
    }
}