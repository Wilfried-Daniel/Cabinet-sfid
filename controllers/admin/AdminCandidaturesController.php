<?php

require_once __DIR__ . '/../../config/bdd.php';
require_once __DIR__ . '/../../models/admin/AdminCandidatureModel.php';

$candidatureModel = new AdminCandidatureModel($pdo);
$totalCandidatures = $candidatureModel->getTotalOffres();
$limit = 6;
$pageCount = max(1, (int) ceil($totalCandidatures / $limit));
$page = filter_var($_GET['page_num'] ?? 1, FILTER_VALIDATE_INT);
$page = max(1, min($pageCount, $page ?: 1));
$candidatures = $candidatureModel->getCandidaturesOffres($limit, ($page - 1) * $limit);

require_once __DIR__ . '/../../views/admin/dashboard/candidatures.php';