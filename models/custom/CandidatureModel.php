<!-- INSERT des données du candidat -->

<?php // Fichier : models/CandidatureModel.php
// Fichier : models/CandidatureModel.php
// Fichier : models/CandidatureModel.php
class CandidatureModel
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    /**
     * Crée ou met à jour un candidat et enregistre sa candidature spontanée.
     */
    public function enregistrerCandidatureSpontanee(
        array $dataCandidat,
        array $dataCandidature,
        array $documents = [],
    ): bool {
        try {
            $this->db->beginTransaction();

            // 1. Recherche ou création du candidat selon l'e-mail
            $stmt = $this->db->prepare(
                'SELECT id FROM candidats WHERE email = :email LIMIT 1',
            );
            $stmt->execute(['email' => $dataCandidat['email']]);
            $candidat = $stmt->fetch();

            if ($candidat) {
                $candidatId = $candidat['id'];
                // Optionnel : Mettre à jour les infos du candidat si nécessaire
                $updateStmt = $this->db->prepare("
                    UPDATE candidats 
                    SET nom_complet = :nom_complet, telephone = :telephone, updated_at = NOW()
                    WHERE id = :id
                ");
                $updateStmt->execute([
                    'nom_complet' => $dataCandidat['nom_complet'],
                    'telephone' => $dataCandidat['telephone'],
                    'id' => $candidatId,
                ]);
            } else {
                $insertCandidat = $this->db->prepare("
                    INSERT INTO candidats (nom_complet, email, telephone, created_at, updated_at)
                    VALUES (:nom_complet, :email, :telephone, NOW(), NOW())
                ");
                $insertCandidat->execute([
                    'nom_complet' => $dataCandidat['nom_complet'],
                    'email' => $dataCandidat['email'],
                    'telephone' => $dataCandidat['telephone'],
                ]);
                $candidatId = $this->db->lastInsertId();
            }

            // 2. Enregistrement dans la table candidatures
            $insertCandidature = $this->db->prepare("
                INSERT INTO candidatures (candidat_id, offre_id, type, domaine, message, date_candidature, created_at, updated_at)
                VALUES (:candidat_id, NULL, 'spontanee', :domaine, :message, NOW(), NOW(), NOW())
            ");
            $insertCandidature->execute([
                'candidat_id' => $candidatId,
                'domaine' => $dataCandidature['domaine'],
                'message' => $dataCandidature['message'],
            ]);

            $candidatureId = $this->db->lastInsertId();

            // 3. Insertion des documents dans 'documents_candidatures'
            $insertDoc = $this->db->prepare("
                INSERT INTO documents_candidatures 
                (candidature_id, type, nom_original, nom_fichier, chemin, type_mime, taille) 
                VALUES (:candidature_id, :type, :nom_original, :nom_fichier, :chemin, :type_mime, :taille)
            ");

            foreach ($documents as $doc) {
                if ($doc) {
                    $insertDoc->execute([
                        'candidature_id' => $candidatureId,
                        'type' => $doc['type'], // 'cv' ou 'lettre_motivation'
                        'nom_original' => $doc['nom_original'],
                        'nom_fichier' => $doc['nom_fichier'],
                        'chemin' => $doc['chemin'],
                        'type_mime' => $doc['type_mime'],
                        'taille' => $doc['taille'],
                    ]);
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log('Erreur Candidature Spontanée : ' . $e->getMessage());
            // AFFICHAGE TEMPORAIRE POUR LE DÉBOGAGE :
            // var_dump("Erreur exacte SQL / PHP : " . $e->getMessage());
            // die();
            return false;
        }
    }

    /**
     * Récupère toutes les candidatures spontanées avec les détails du candidat
     * et les indicateurs de pièces jointes (has_cv, has_lm)
     */
    public function getCandidaturesSpontanees(int $limit = 6, int $offset = 0): array
    {
        $sql = "SELECT 
                c.id,
                cand.nom_complet,
                cand.email,
                cand.telephone,
                c.domaine,
                c.message,
                c.date_candidature,
                MAX(CASE WHEN doc.type = 'cv' THEN 1 ELSE 0 END) AS has_cv,
                MAX(CASE WHEN doc.type = 'lettre_motivation' THEN 1 ELSE 0 END) AS has_lm
            FROM candidatures c
            INNER JOIN candidats cand ON c.candidat_id = cand.id
            LEFT JOIN documents_candidatures doc ON doc.candidature_id = c.id
            WHERE c.type = 'spontanee'
            GROUP BY 
                c.id, 
                cand.nom_complet, 
                cand.email, 
                cand.telephone, 
                c.domaine, 
                c.message, 
                c.date_candidature
            ORDER BY c.date_candidature DESC
            LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère le nombre total de candidatures spontanées
    public function getTotalSpontanees(): int {
        $sql = "SELECT COUNT(*) FROM candidatures WHERE type = 'spontanee'";
        return (int) $this->db->query($sql)->fetchColumn();
    }
}
