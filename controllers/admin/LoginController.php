<?php

// 1. Inclusion de VOTRE fichier de connexion et du modèle
require_once __DIR__ . '/../../config/bdd.php'; 
require_once __DIR__ . '/../../models/admin/LoginModel.php';

$error = null;

function nettoyer_champ(string $donnees)
{
    return htmlspecialchars(stripslashes(trim($donnees)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupération et nettoyage des données
    $email = nettoyer_champ($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    // Validation des différents champs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error['email'] = "Veuillez entrer un email valide.";
    if (strlen($password) < 8) $error['password'] = "Le mot de passe doit contenir au moins 8 caractères.";

    if (!empty($email) && !empty($password)) {
        
        // 2. On instancie le modèle en lui passant votre variable $pdo
        $adminModel = new LoginModel($pdo);
        $admin = $adminModel->getAdminByEmail($email);

        if ($admin && password_verify($password, $admin['password'])) {
            
            session_regenerate_id(true);

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            
            $adminModel->updateLastLogin($admin['id']);

            // 3. Redirection vers votre tableau de bord (à adapter selon vos routes)
            header("Location: index.php?page=dashboard");
            // header("Location: /views/admin/dashboard/stats.php");
            exit;

        } else {
            $error = "Adresse e-mail ou mot de passe incorrect.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

// 4. Inclusion de votre vue contenant le formulaire HTML Tailwind
require_once __DIR__ . '/../../views/admin/login.php';