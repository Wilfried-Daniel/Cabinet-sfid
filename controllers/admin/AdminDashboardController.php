<?php

require_once __DIR__ . '/../../config/bdd.php';
require_once __DIR__ . '/../../models/admin/AdminDashboardModel.php';

$dashboardModel = new AdminDashboardModel($pdo);
$adminName = $dashboardModel->getAdminName((int) $_SESSION['admin_id']) ?? ($_SESSION['admin_name'] ?? 'Administrateur');
$_SESSION['admin_name'] = $adminName;
$dashboardKpis = $dashboardModel->getKpis();
$applicationChart = $dashboardModel->getApplicationsLastSevenDays();

require __DIR__ . '/../../views/admin/dashboard/stats.php';
