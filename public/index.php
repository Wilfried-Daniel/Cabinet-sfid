<?php
// Fichier : public/index.php
ob_start();

// Initialisation des sessions sécurisées pour l'espace Admin
session_start([
    'cookie_lifetime' => 86400, // La session reste active pendant 24 heures (86400 secondes)
    'cookie_secure' => false, // Mettez à 'true' plus tard quand le site aura un certificat HTTPS
    'cookie_httponly' => true, // Sécurité majeure : interdit à JavaScript d'accéder au cookie de session (bloque le vol de session)
    'cookie_samesite' => 'Lax', // Protection contre les attaques CSRF (les formulaires falsifiés provenant d'autres sites)
]);

// Inclusion de la connexion BDD (qui inclut déjà l'autoloader Composer)
require_once __DIR__ . '/../config/bdd.php';

// Récupération et nettoyage du paramètre de page demandé (Ex: index.php?page=offres)
$page = isset($_GET['page']) ? trim(strtolower($_GET['page'])) : 'accueil';

// Liste blanche des pages autorisées sur le site pour éviter les inclusions de fichiers malveillants
$pages_publiques = [
    // CUSTOMS
    'accueil' => __DIR__ . '/../views/customs/pages/accueil.php',
    'contact' => __DIR__ . '/../views/customs/pages/contact.php',
    'offres' => __DIR__ . '/../controllers/custom/CandidatureSpontaneeController.php',
    // 'offres' => __DIR__ . '/../views/customs/pages/offre.php',
    // 'detail-offre'  => __DIR__ . '/../views/customs/pages/detail-offre.php',
    'services' => __DIR__ . '/../views/customs/pages/services.php',
    'apropos' => __DIR__ . '/../views/customs/pages/apropos.php',
    'error404' => __DIR__ . '/../views/customs/pages/error404.php',

    // ADMIN
    // C'est le contrôleur qui s'occupera d'afficher la vue à la fin.
    'login' => __DIR__ . '/../controllers/admin/LoginController.php',
    'logout' => __DIR__ . '/../controllers/admin/LogoutController.php',
    'spontanee'     => __DIR__ . '/../controllers/admin/AdminSpontaneeController.php',

    // vues
    'dashboard' => __DIR__ . '/../views/admin/dashboard/stats.php',
    'candidatures' => __DIR__ . '/../views/admin/dashboard/candidatures.php',
    // 'spontanee' => __DIR__ . '/../views/admin/dashboard/spontanee.php',
    'ajouter-offre' => __DIR__ . '/../views/admin/dashboard/add-offre.php',
    'profil' => __DIR__ . '/../views/admin/dashboard/profil.php',
];

// Si la page demandée ne se trouve pas dans notre tableau de pages on retourne la page 404
if (!array_key_exists($page, $pages_publiques)) {
    http_response_code(404);
    $page = 'error404'; // On force la page à être l'erreur 404
}

// Protection de l'espace d'administration
$pages_admin = ['dashboard', 'candidatures', 'spontanee', 'ajouter-offre', 'profil'];
// Si la page demandée fait partie de l'espace admin, on vérifie si l'admin s'est connecté (grâce à la session).
// Si NON on refuse l'accès et on le renvoie sur la page de connexion
if (in_array($page, $pages_admin)) {
    if (!isset($_SESSION['admin_id'])) {
        header('Location: index.php?page=login');
        exit();
    }
}

// Détermination du type de mise en page (Layout)
// On liste les pages qui n'ont PAS BESOIN du header/footer vitrine (ex: l'administration)
$pages_sans_gabarit = [
    'login',
    'logout',
    'dashboard',
    'candidatures',
    'spontanee',
    'ajouter-offre',
    'profil',
];
$afficher_gabarit = !in_array($page, $pages_sans_gabarit);

// ==========================================
// RENDER / AFFICHAGE DYNAMIQUE DU SITE
// ==========================================

// Si c'est une page vitrine, on affiche le HEADER commun
if ($afficher_gabarit) {
    require_once __DIR__ . '/../views/partials/header.php';
}

// On charge le CONTENU UNIQUE de la page demandée
$fichier_final = realpath($pages_publiques[$page]);
if ($fichier_final !== false) {
    require_once $fichier_final;
}

// Si c'est une page vitrine, on ferme le site avec le FOOTER commun
if ($afficher_gabarit) {
    require_once __DIR__ . '/../views/partials/footer.php';
}
