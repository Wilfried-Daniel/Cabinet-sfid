<?php

require_once __DIR__ . '/../../config/bdd.php';
require_once __DIR__ . '/../../models/admin/OffreModel.php';

$offreModel = new OffreModel($pdo);
$offreModel->closeExpired();
$offreSuccess = $_SESSION['offre_flash_success'] ?? null;
unset($_SESSION['offre_flash_success']);
$offreError = null;
$offreForm = $_POST;
$openEditId = null;
$statutFermee = html_entity_decode('ferm&#xE9;e', ENT_QUOTES, 'UTF-8');

if (!isset($_SESSION['csrf_offre_token'])) {
    $_SESSION['csrf_offre_token'] = bin2hex(random_bytes(32));
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $csrfToken = $_POST['csrf_token'] ?? '';
    $action = (string) ($_POST['action'] ?? '');

    if (!is_string($csrfToken) || !hash_equals($_SESSION['csrf_offre_token'], $csrfToken)) {
        $offreError = 'Session expiree. Rechargez la page puis reessayez.';
    } elseif ($action === 'delete') {
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        try {
            if (!$id || !$offreModel->delete((int) $id)) {
                $offreError = 'Echec de suppression de l’offre.';
            } else {
                $_SESSION['offre_flash_success'] = 'Offre supprimee avec succes.';
                $_SESSION['csrf_offre_token'] = bin2hex(random_bytes(32));
                redirectToOfferList();
            }
        } catch (Throwable $exception) {
            error_log('Erreur de suppression offre : ' . $exception->getMessage());
            $offreError = 'Impossible de supprimer cette offre. Elle est peut-etre liee a des candidatures.';
        }
    } elseif ($action === 'create' || $action === 'update') {
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        $titre = trim((string) ($_POST['titre'] ?? ''));
        $statut = (string) ($_POST['statut'] ?? '');
        $datePublicationInput = trim((string) ($_POST['date_publication'] ?? ''));
        $dateClotureInput = trim((string) ($_POST['date_cloture'] ?? ''));
        $description = trim((string) ($_POST['description'] ?? ''));
        $datePublication = null;
        $dateCloture = null;

        if ($action === 'update') {
            $openEditId = $id ? (int) $id : null;
        }
        if ($titre === '' || iconv_strlen($titre, 'UTF-8') > 150) {
            $offreError = 'Le titre est obligatoire et limite a 150 caracteres.';
        } elseif (!in_array($statut, ['ouverte', $statutFermee], true)) {
            $offreError = 'Selectionnez un statut valide.';
        } elseif ($action === 'update' && !$id) {
            $offreError = 'Offre invalide.';
        } elseif ($action === 'create' && $description === '') {
            $offreError = 'La description est obligatoire.';
        } else {
            if ($action === 'update') {
                $datePublication = parseOfferDate($datePublicationInput);
                if ($datePublication === null) {
                    $offreError = 'Date de publication invalide.';
                }
            } else {
                $datePublication = date('Y-m-d H:i:s');
            }
            if ($offreError === null && $dateClotureInput !== '') {
                $dateCloture = parseOfferDate($dateClotureInput);
                if ($dateCloture === null) {
                    $offreError = 'Date de cloture invalide.';
                }
            }
            if ($offreError === null && $dateCloture !== null && $datePublication !== null && $dateCloture < $datePublication) {
                $offreError = 'La date de cloture doit suivre la date de publication.';
            }
        }

        if ($offreError === null) {
            try {
                if ($action === 'create') {
                    $offreModel->create($titre, $description, $statut, $dateCloture);
                    $_SESSION['offre_flash_success'] = 'Offre ajoutee avec succes.';
                } elseif (!$offreModel->update((int) $id, $titre, $statut, $datePublication, $dateCloture)) {
                    $offreError = 'Offre introuvable.';
                } else {
                    $_SESSION['offre_flash_success'] = 'Offre modifiee avec succes.';
                }
                if ($offreError === null) {
                    $_SESSION['csrf_offre_token'] = bin2hex(random_bytes(32));
                    redirectToOfferList();
                }
            } catch (Throwable $exception) {
                error_log('Erreur sauvegarde offre : ' . $exception->getMessage());
                $offreError = 'Impossible de sauvegarder. Verifiez la base de donnees.';
            }
        }
    } else {
        $offreError = 'Requete invalide.';
    }
}

$statutFilter = (string) ($_GET['statut'] ?? 'tous');
if (!in_array($statutFilter, ['tous', 'ouverte', 'fermee'], true)) {
    $statutFilter = 'tous';
}
$statutQuery = $statutFilter === 'fermee' ? $statutFermee : ($statutFilter === 'ouverte' ? 'ouverte' : null);
$offreTotal = $offreModel->getCount($statutQuery);
$offrePageSize = 6;
$offrePageCount = max(1, (int) ceil($offreTotal / $offrePageSize));
$offrePage = filter_var($_GET['page_num'] ?? 1, FILTER_VALIDATE_INT);
$offrePage = max(1, min($offrePageCount, $offrePage ?: 1));
$offres = $offreModel->getPage($offrePageSize, ($offrePage - 1) * $offrePageSize, $statutQuery);
$offreAllCount = $offreModel->getCount();

function parseOfferDate(string $value): ?string
{
    $date = DateTimeImmutable::createFromFormat('!Y-m-d\\TH:i', $value);
    $errors = DateTimeImmutable::getLastErrors();
    if (!$date || ($errors !== false && ($errors['warning_count'] > 0 || $errors['error_count'] > 0))) {
        return null;
    }
    return $date->format('Y-m-d H:i:s');
}

function redirectToOfferList(): void
{
    $filter = (string) ($_POST['return_statut'] ?? 'tous');
    $page = filter_var($_POST['return_page'] ?? 1, FILTER_VALIDATE_INT);
    if (!in_array($filter, ['tous', 'ouverte', 'fermee'], true)) {
        $filter = 'tous';
    }
    $page = max(1, $page ?: 1);
    header('Location: index.php?page=ajouter-offre&statut=' . rawurlencode($filter) . '&page_num=' . $page);
    exit;
}

require_once __DIR__ . '/../../views/admin/dashboard/add-offre.php';