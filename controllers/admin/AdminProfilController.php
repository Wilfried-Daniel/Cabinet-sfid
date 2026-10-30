<?php

require_once __DIR__ . '/../../config/bdd.php';
require_once __DIR__ . '/../../models/admin/AdminProfileModel.php';

$adminId = (int) ($_SESSION['admin_id'] ?? 0);
$profileModel = new AdminProfileModel($pdo);
$admin = $profileModel->findById($adminId);

if (!$admin) {
    session_destroy();
    header('Location: index.php?page=login');
    exit;
}

if (empty($_SESSION['profile_csrf_token'])) {
    $_SESSION['profile_csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flash = ['type' => 'error', 'message' => 'La modification n’a pas pu être enregistrée.'];
    $token = (string) ($_POST['csrf_token'] ?? '');
    if (!hash_equals($_SESSION['profile_csrf_token'], $token)) {
        $flash['message'] = 'La session du formulaire a expiré. Réessayez.';
    } else {
        try {
            $action = $_POST['action'] ?? '';
            if ($action === 'update_name') {
                $name = trim((string) ($_POST['name'] ?? ''));
                $nameLength = preg_match_all('/./us', $name);
                if ($name === '' || $nameLength === false || $nameLength > 255) {
                    $flash['message'] = 'Le nom est obligatoire et ne doit pas dépasser 255 caractères.';
                } elseif ($profileModel->updateName($adminId, $name)) {
                    $_SESSION['admin_name'] = $name;
                    $flash = ['type' => 'success', 'message' => 'Votre nom a bien été mis à jour.'];
                }
            } elseif ($action === 'change_password') {
                $currentPassword = (string) ($_POST['current_password'] ?? '');
                $newPassword = (string) ($_POST['new_password'] ?? '');
                $confirmation = (string) ($_POST['confirm_password'] ?? '');
                if (!password_verify($currentPassword, $admin['password'])) {
                    $flash['message'] = 'Le mot de passe actuel est incorrect.';
                } elseif (preg_match_all('/./us', $newPassword) < 8
                    || !preg_match('/[a-z]/', $newPassword)
                    || !preg_match('/[A-Z]/', $newPassword)
                    || !preg_match('/[^a-zA-Z0-9]/u', $newPassword)) {
                    $flash['message'] = 'Le nouveau mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un caractère spécial.';
                } elseif ($newPassword !== $confirmation) {
                    $flash['message'] = 'La confirmation du nouveau mot de passe ne correspond pas.';
                } elseif ($profileModel->updatePassword($adminId, password_hash($newPassword, PASSWORD_DEFAULT))) {
                    $flash = ['type' => 'success', 'message' => 'Votre mot de passe a bien été modifié.'];
                }
            } else {
                $flash['message'] = 'Action non reconnue.';
            }
        } catch (Throwable $exception) {
            error_log('Admin profile update failed: ' . $exception->getMessage());
            $flash['message'] = 'Une erreur est survenue lors de la mise à jour.';
        }
    }

    $_SESSION['profile_flash'] = $flash;
    header('Location: index.php?page=profil');
    exit;
}

$profileFlash = $_SESSION['profile_flash'] ?? null;
unset($_SESSION['profile_flash']);
require __DIR__ . '/../../views/admin/dashboard/profil.php';
