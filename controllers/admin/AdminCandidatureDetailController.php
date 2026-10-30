<?php

require_once __DIR__ . '/../../config/bdd.php';
require_once __DIR__ . '/../../models/admin/AdminCandidatureModel.php';

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
$candidatureModel = new AdminCandidatureModel($pdo);
$candidature = $id && $id > 0 ? $candidatureModel->getCandidatureSpontaneeById($id) : null;

if (!$candidature) {
    http_response_code(404);
    require __DIR__ . '/../../views/customs/pages/error404.php';
    return;
}

require __DIR__ . '/../../views/admin/dashboard/candidature-spontanee-detail.php';
