<?php
// Fichier : controllers/custom/CandidatureSpontaneeController.php

// Correction des chemins d'accès (2 niveaux plus haut vers la racine)
require_once __DIR__ . '/../../config/bdd.php';
require_once __DIR__ . '/../../models/custom/CandidatureModel.php';

$errors = [];
$success_message = null;

function nettoyer_champ(string $donnees): string
{
    return htmlspecialchars(stripslashes(trim($donnees)));
}

/**
 * Fonction helper pour valider et uploader un fichier
 * Retourne le tableau des métadonnées du document pour la BDD
 */
function traiter_upload(
    array $file,
    string $dossierCible,
    string $sousDossier,
    string $typeDocument,
    array &$errors,
    string $cleChamp,
): ?array {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        $errors[$cleChamp] = 'Le fichier est obligatoire et doit être valide.';
        return null;
    }

    $maxSize = 5 * 1024 * 1024; // 5 Mo
    if ($file['size'] > $maxSize) {
        $errors[$cleChamp] = 'La taille du fichier ne doit pas dépasser 5 Mo.';
        return null;
    }

    $mimesAutorises = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' =>
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];

    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!array_key_exists($fileExt, $mimesAutorises)) {
        $errors[$cleChamp] =
            'Format non autorisé. Formats acceptés : PDF, DOC, DOCX.';
        return null;
    }

    // Création du répertoire de destination si inexistant
    if (!is_dir($dossierCible)) {
        mkdir($dossierCible, 0755, true);
    }

    // Génération d'un nom de fichier unique sécurisé
    $nouveauNom = uniqid('doc_', true) . '.' . $fileExt;
    $cheminFinal = $dossierCible . '/' . $nouveauNom;

    if (move_uploaded_file($file['tmp_name'], $cheminFinal)) {
        return [
            'type' => $typeDocument, // 'cv' ou 'lettre_motivation'
            'nom_original' => $file['name'],
            'nom_fichier' => $nouveauNom,
            'chemin' => 'uploads/' . $sousDossier . '/' . $nouveauNom,
            'type_mime' => $file['type'] ?? $mimesAutorises[$fileExt],
            'taille' => $file['size'],
        ];
    }

    $errors[$cleChamp] = "Erreur lors de l'enregistrement du fichier.";
    return null;
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    ($_POST['type_candidature'] ?? '') === 'spontanee'
) {
    // 1. Récupération et nettoyage des champs texte
    $nom_complet = nettoyer_champ($_POST['nom_complet'] ?? '');
    $email = nettoyer_champ($_POST['email'] ?? '');
    $telephone = nettoyer_champ($_POST['telephone'] ?? '');
    $domaine = nettoyer_champ($_POST['domaine'] ?? '');
    $message = nettoyer_champ($_POST['message'] ?? '');

    // 2. Validation des champs texte
    if (empty($nom_complet)) {
        $errors['nom_complet'] = 'Le nom complet est obligatoire.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Veuillez entrer une adresse e-mail valide.';
    }

    if (empty($telephone)) {
        $errors['telephone'] = 'Le numéro de téléphone est obligatoire.';
    }

    $domainesAutorises = [
        'comptabilite-fiscalite',
        'juridique-social',
        'communication',
        'finance',
        'autre',
    ];
    if (!in_array($domaine, $domainesAutorises, true)) {
        $errors['domaine'] = 'Veuillez sélectionner un domaine valide.';
    }

    // 3. Traitement des pièces jointes (Chemin corrigé vers public/uploads)
    $uploadDir = __DIR__ . '/../../public/uploads';

    $docCV = traiter_upload(
        $_FILES['cv'] ?? [],
        $uploadDir . '/cv',
        'cv',
        'cv',
        $errors,
        'cv',
    );
    $docLM = traiter_upload(
        $_FILES['lettre_motivation'] ?? [],
        $uploadDir . '/lm',
        'lm',
        'lettre_motivation',
        $errors,
        'lettre_motivation',
    );

    // 4. Enregistrement en base de données si aucune erreur
    if (empty($errors)) {
        $candidatureModel = new CandidatureModel($pdo);

        $dataCandidat = [
            'nom_complet' => $nom_complet,
            'email' => $email,
            'telephone' => $telephone,
        ];

        $dataCandidature = [
            'domaine' => $domaine,
            'message' => $message,
        ];

        $documents = array_filter([$docCV, $docLM]);

        if (
            $candidatureModel->enregistrerCandidatureSpontanee(
                $dataCandidat,
                $dataCandidature,
                $documents,
            )
        ) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['flash_success'] =
                'Votre candidature spontanée a été envoyée avec succès !';
            header(
                'Location: index.php?page=offres&status=success#form-spontanee',
            );
            exit();
        } else {
            $errors['global'] =
                "Une erreur serveur est survenue lors de l'enregistrement.";
        }
    }
}

// Chargement de la vue des offres (Chemin corrigé vers views/customs/pages/offre.php)
require_once __DIR__ . '/../../views/customs/pages/offre.php';
