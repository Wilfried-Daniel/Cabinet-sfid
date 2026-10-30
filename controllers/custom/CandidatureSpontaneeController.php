<?php
// Fichier : controllers/custom/CandidatureSpontaneeController.php

// Correction des chemins d'accès (2 niveaux plus haut vers la racine)
require_once __DIR__ . '/../../config/bdd.php';
require_once __DIR__ . '/../../models/custom/CandidatureModel.php';
require_once __DIR__ . '/../../models/custom/OffreModel.php';

$errors = [];
$success_message = null;
$offrePostErrors = [];
$offrePostForm = [];
$selectedOffreTitle = '';

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
    if (!isset($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $errors[$cleChamp] = 'Le fichier est obligatoire et doit être valide.';
        return null;
    }

    $maxSize = 5 * 1024 * 1024; // 5 Mo
    if (($file['size'] ?? 0) > $maxSize) {
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
        $errors[$cleChamp] = 'Format non autorise. Formats acceptes : PDF, DOC, DOCX.';
        return null;
    }

    $typesMimeAutorises = [
        'pdf' => ['application/pdf'],
        'doc' => ['application/msword', 'application/x-ole-storage'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'],
    ];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeReel = $finfo ? finfo_file($finfo, $file['tmp_name']) : false;
    if ($finfo) {
        finfo_close($finfo);
    }
    if (!$mimeReel || !in_array($mimeReel, $typesMimeAutorises[$fileExt], true)) {
        $errors[$cleChamp] = 'Le contenu du fichier ne correspond pas a son format.';
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
            'type_mime' => $mimeReel,
            'taille' => $file['size'],
        ];
    }

    $errors[$cleChamp] = "Erreur lors de l'enregistrement du fichier.";
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['type_candidature'] ?? '') === 'poste') {
    $offrePostForm = $_POST;
    $nomComplet = trim((string) ($_POST['nom_complet'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $telephone = trim((string) ($_POST['telephone'] ?? ''));
    $messageOffre = trim((string) ($_POST['message'] ?? ''));
    $offreId = filter_var($_POST['offre_id'] ?? null, FILTER_VALIDATE_INT);
    $offreModel = new OffreModel($pdo);
    $offreChoisie = $offreId ? $offreModel->getOffreOuverteParId((int) $offreId) : null;
    $selectedOffreTitle = $offreChoisie['titre'] ?? '';

    if (iconv_strlen($nomComplet, 'UTF-8') < 2 || iconv_strlen($nomComplet, 'UTF-8') > 255) {
        $offrePostErrors['nom_complet'] = 'Saisissez un nom complet valide.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
        $offrePostErrors['email'] = 'Saisissez une adresse e-mail valide.';
    }
    if ($telephone === '' || strlen($telephone) > 30) {
        $offrePostErrors['telephone'] = 'Saisissez un numero de telephone valide.';
    }
    if (!$offreChoisie) {
        $offrePostErrors['offre_id'] = 'Cette offre n’est plus disponible. Choisissez une autre offre.';
    }

    $uploadDir = __DIR__ . '/../../public/uploads';
    $docCV = traiter_upload($_FILES['cv'] ?? [], $uploadDir . '/cv', 'cv', 'cv', $offrePostErrors, 'cv');
    $docLM = traiter_upload($_FILES['lettre_motivation'] ?? [], $uploadDir . '/lm', 'lm', 'lettre_motivation', $offrePostErrors, 'lettre_motivation');

    if (!$offrePostErrors) {
        $documentsOffre = [$docCV, $docLM];
        $saved = (new CandidatureModel($pdo))->enregistrerCandidatureOffre(
            ['nom_complet' => $nomComplet, 'email' => $email, 'telephone' => $telephone],
            (int) $offreId,
            $messageOffre,
            $documentsOffre
        );
        if ($saved) {
            $_SESSION['flash_offre_success'] = 'Votre candidature a ete envoyee avec succes.';
            header('Location: index.php?page=offres#form-postes');
            exit();
        }
        $offrePostErrors['global'] = 'Une erreur est survenue pendant l’enregistrement. Veuillez reessayer.';
    }

    if ($offrePostErrors) {
        foreach ([$docCV ?? null, $docLM ?? null] as $document) {
            if ($document) {
                $absolutePath = __DIR__ . '/../../public/' . $document['chemin'];
                if (is_file($absolutePath)) {
                    unlink($absolutePath);
                }
            }
        }
    }
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
$offresOuvertes = (new OffreModel($pdo))->getOffresOuvertes();

require_once __DIR__ . '/../../views/customs/pages/offre.php';
