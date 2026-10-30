<?php

class OffreModel
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getOffresOuvertes(): array
    {
        $statement = $this->pdo->prepare(
            "SELECT id, titre, slug, description, statut, date_publication, date_cloture
             FROM offres
             WHERE statut = :statut
               AND (date_cloture IS NULL OR date_cloture >= CURRENT_TIMESTAMP)
             ORDER BY date_publication DESC, id DESC"
        );
        $statement->execute(['statut' => 'ouverte']);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOffreOuverteParId(int $id): ?array
    {
        $statement = $this->pdo->prepare(
            "SELECT id, titre FROM offres
             WHERE id = :id AND statut = :statut
               AND (date_cloture IS NULL OR date_cloture >= CURRENT_TIMESTAMP)
             LIMIT 1"
        );
        $statement->execute(['id' => $id, 'statut' => 'ouverte']);
        $offre = $statement->fetch(PDO::FETCH_ASSOC);
        return $offre ?: null;
    }}