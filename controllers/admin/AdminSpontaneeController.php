<?php
// Fichier : controllers/admin/AdminSpontaneeController.php

require_once __DIR__ . '/../../config/bdd.php';
require_once __DIR__ . '/../../models/custom/CandidatureModel.php';

// Instance du modèle
$candidatureModel = new CandidatureModel($pdo);

// 1. Détection d'une requête AJAX (Clic sur "Voir plus")
if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    // Vide tout texte, HTML ou espace affiché avant cette ligne
    if (ob_get_length()) {
        ob_clean();
    }

    header('Content-Type: application/json; charset=utf-8');
    
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
    $limit = 6;
    
    $items = $candidatureModel->getCandidaturesSpontanees($limit, $offset);
    $total = $candidatureModel->getTotalSpontanees();
    
    // Renvoyer les données en JSON
    echo json_encode([
        'success' => true,
        'candidatures' => $items,
        'hasMore' => ($offset + count($items)) < $total
    ]);
    exit();
}

// 2. Chargement initial de la page (les 6 premières candidatures)
$limit = 6;
$offset = 0;
$candidatures = $candidatureModel->getCandidaturesSpontanees($limit, $offset);
$totalCandidatures = $candidatureModel->getTotalSpontanees();
$hasMore = $totalCandidatures > $limit;

// Inscription de la vue d'administration
require_once __DIR__ . '/../../views/admin/dashboard/spontanee.php';