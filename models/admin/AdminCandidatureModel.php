<?php

class AdminCandidatureModel
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getTotalOffres(): int
    {
        $statement = $this->pdo->query("SELECT COUNT(*) FROM candidatures WHERE type = 'offre'");
        return (int) $statement->fetchColumn();
    }

    public function getTotalSpontanees(): int
    {
        $statement = $this->pdo->query("SELECT COUNT(*) FROM candidatures WHERE type = 'spontanee'");
        return (int) $statement->fetchColumn();
    }

    public function getCandidatureSpontaneeById(int $id): ?array
    {
        $statement = $this->pdo->prepare(
            "SELECT c.id, c.domaine, c.message, c.date_candidature,
                    cand.nom_complet, cand.email, cand.telephone
             FROM candidatures c
             INNER JOIN candidats cand ON cand.id = c.candidat_id
             WHERE c.id = :id AND c.type = 'spontanee' LIMIT 1"
        );
        $statement->execute(['id' => $id]);
        $candidature = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$candidature) {
            return null;
        }

        $documents = $this->pdo->prepare(
            'SELECT type, nom_original, chemin, type_mime, taille
             FROM documents_candidatures WHERE candidature_id = :id ORDER BY created_at ASC, id ASC'
        );
        $documents->execute(['id' => $id]);
        $candidature['documents'] = $documents->fetchAll(PDO::FETCH_ASSOC);
        return $candidature;
    }

    public function getCandidaturesOffres(int $limit, int $offset): array
    {
        $statement = $this->pdo->prepare(
            "SELECT c.id, c.message, c.date_candidature, c.poste,
                    cand.nom_complet, cand.email, cand.telephone,
                    o.titre AS offre_titre,
                    MAX(CASE WHEN doc.type = 'cv' THEN doc.chemin END) AS cv_chemin,
                    MAX(CASE WHEN doc.type = 'cv' THEN doc.nom_original END) AS cv_nom,
                    MAX(CASE WHEN doc.type = 'lettre_motivation' THEN doc.chemin END) AS lm_chemin,
                    MAX(CASE WHEN doc.type = 'lettre_motivation' THEN doc.nom_original END) AS lm_nom
             FROM candidatures c
             INNER JOIN candidats cand ON cand.id = c.candidat_id
             LEFT JOIN offres o ON o.id = c.offre_id
             LEFT JOIN documents_candidatures doc ON doc.candidature_id = c.id
             WHERE c.type = 'offre'
             GROUP BY c.id, c.message, c.date_candidature, c.poste,
                      cand.nom_complet, cand.email, cand.telephone, o.titre
             ORDER BY c.date_candidature DESC, c.id DESC
             LIMIT :limit OFFSET :offset"
        );
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
