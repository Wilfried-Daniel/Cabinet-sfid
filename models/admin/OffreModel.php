<?php

class OffreModel
{
    private string $statutFermee;

    public function __construct(private PDO $pdo)
    {
        $this->statutFermee = html_entity_decode('ferm&#xE9;e', ENT_QUOTES, 'UTF-8');
    }

    public function closeExpired(): void
    {
        $statement = $this->pdo->prepare(
            'UPDATE offres SET statut = :statut, updated_at = CURRENT_TIMESTAMP
             WHERE statut = :statut_ouvert AND date_cloture IS NOT NULL AND date_cloture < CURRENT_TIMESTAMP'
        );
        $statement->execute(['statut' => $this->statutFermee, 'statut_ouvert' => 'ouverte']);
    }

    public function getCount(?string $statut = null): int
    {
        if ($statut === null) {
            return (int) $this->pdo->query('SELECT COUNT(*) FROM offres')->fetchColumn();
        }
        $statement = $this->pdo->prepare('SELECT COUNT(*) FROM offres WHERE statut = :statut');
        $statement->execute(['statut' => $statut]);
        return (int) $statement->fetchColumn();
    }

    public function getPage(int $limit, int $offset, ?string $statut = null): array
    {
        $sql = 'SELECT id, titre, slug, description, statut, date_publication, date_cloture FROM offres';
        if ($statut !== null) {
            $sql .= ' WHERE statut = :statut';
        }
        $sql .= ' ORDER BY date_publication DESC, id DESC LIMIT :limit OFFSET :offset';
        $statement = $this->pdo->prepare($sql);
        if ($statut !== null) {
            $statement->bindValue(':statut', $statut, PDO::PARAM_STR);
        }
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function create(string $titre, string $description, string $statut, ?string $dateCloture): int
    {
        $slug = $this->uniqueSlug($titre);
        $statement = $this->pdo->prepare(
            'INSERT INTO offres (titre, slug, description, statut, date_publication, date_cloture, created_at, updated_at)
             VALUES (:titre, :slug, :description, :statut, CURRENT_TIMESTAMP, :date_cloture, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)'
        );
        $statement->execute([
            'titre' => $titre,
            'slug' => $slug,
            'description' => $description,
            'statut' => $statut,
            'date_cloture' => $dateCloture,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, string $titre, string $statut, string $datePublication, ?string $dateCloture): bool
    {
        $check = $this->pdo->prepare('SELECT 1 FROM offres WHERE id = :id');
        $check->execute(['id' => $id]);
        if (!$check->fetchColumn()) {
            return false;
        }

        $statement = $this->pdo->prepare(
            'UPDATE offres SET titre = :titre, slug = :slug, statut = :statut,
             date_publication = :date_publication, date_cloture = :date_cloture,
             updated_at = CURRENT_TIMESTAMP WHERE id = :id'
        );
        $statement->execute([
            'titre' => $titre,
            'slug' => $this->uniqueSlug($titre, $id),
            'statut' => $statut,
            'date_publication' => $datePublication,
            'date_cloture' => $dateCloture,
            'id' => $id,
        ]);
        return true;
    }

    public function delete(int $id): bool
    {
        $statement = $this->pdo->prepare('DELETE FROM offres WHERE id = :id');
        $statement->execute(['id' => $id]);
        return $statement->rowCount() > 0;
    }
    private function uniqueSlug(string $titre, ?int $excludeId = null): string
    {
        $base = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $titre);
        $base = strtolower((string) $base);
        $base = trim(preg_replace('/[^a-z0-9]+/', '-', $base) ?? '', '-');
        $base = substr($base !== '' ? $base : 'offre', 0, 170);
        $slug = $base;
        $suffix = 2;

        while ($this->slugExists($slug, $excludeId)) {
            $slug = substr($base, 0, 170 - strlen((string) $suffix)) . '-' . $suffix++;
        }
        return $slug;
    }

    private function slugExists(string $slug, ?int $excludeId = null): bool
    {
        $sql = 'SELECT 1 FROM offres WHERE slug = :slug';
        if ($excludeId !== null) {
            $sql .= ' AND id <> :id';
        }
        $sql .= ' LIMIT 1';
        $statement = $this->pdo->prepare($sql);
        $params = ['slug' => $slug];
        if ($excludeId !== null) {
            $params['id'] = $excludeId;
        }
        $statement->execute($params);
        return (bool) $statement->fetchColumn();
    }
}