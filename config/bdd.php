<?php
// Fichier : config/bdd.php

// Chargement automatique des dépendances de Composer (phpdotenv)
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

try {
    // Initialise et charge le fichier .env situé à la racine du projet
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    // Récupération des variables d'environnement
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    // Configuration des options PDO pour la sécurité et la gestion des erreurs
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les exceptions sur les erreurs SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retourne les résultats sous forme de tableau associatif
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Désactive l'émulation pour bloquer les injections SQL de pointe
    ];

    // Création de l'instance unique de connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password, $options);
} catch (Exception $e) {
    // En production, il faudra masquer le message précis pour la sécurité (ex: error_log())
    die("Erreur critique de connexion à la base de données : " . $e->getMessage());
}
