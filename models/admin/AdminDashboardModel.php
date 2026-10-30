<?php

class AdminDashboardModel
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getAdminName(int $adminId): ?string
    {
        $statement = $this->pdo->prepare('SELECT name FROM admins WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $adminId]);
        $name = $statement->fetchColumn();
        return $name === false ? null : (string) $name;
    }

    public function getKpis(): array
    {
        return [
            'applications' => (int) $this->pdo->query('SELECT COUNT(*) FROM candidatures')->fetchColumn(),
            'candidates' => (int) $this->pdo->query('SELECT COUNT(*) FROM candidats')->fetchColumn(),
            'spontaneous' => (int) $this->pdo->query("SELECT COUNT(*) FROM candidatures WHERE type = 'spontanee'")->fetchColumn(),
            'active_offers' => (int) $this->pdo->query(
                "SELECT COUNT(*) FROM offres
                 WHERE statut = 'ouverte'
                   AND (date_cloture IS NULL OR date_cloture >= CURRENT_TIMESTAMP)"
            )->fetchColumn(),
        ];
    }

    public function getApplicationsLastSevenDays(): array
    {
        $today = (string) $this->pdo->query('SELECT CURRENT_DATE')->fetchColumn();
        $statement = $this->pdo->query(
            'SELECT DATE(date_candidature) AS application_day, COUNT(*) AS total
             FROM candidatures
             WHERE date_candidature >= DATE_SUB(CURRENT_DATE, INTERVAL 6 DAY)
               AND date_candidature < CURRENT_TIMESTAMP
             GROUP BY DATE(date_candidature)'
        );

        $countsByDate = [];
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $countsByDate[$row['application_day']] = (int) $row['total'];
        }

        $date = new DateTimeImmutable($today);
        $weekdayLabels = [1 => 'Lun.', 2 => 'Mar.', 3 => 'Mer.', 4 => 'Jeu.', 5 => 'Ven.', 6 => 'Sam.', 7 => 'Dim.'];
        $days = [];
        for ($offset = 6; $offset >= 0; $offset--) {
            $day = $date->modify('-' . $offset . ' days');
            $key = $day->format('Y-m-d');
            $days[] = [
                'date' => $key,
                'label' => $weekdayLabels[(int) $day->format('N')],
                'count' => $countsByDate[$key] ?? 0,
            ];
        }

        $counts = array_column($days, 'count');
        return [
            'days' => $days,
            'total' => array_sum($counts),
            'maximum' => max($counts ?: [0]),
        ];
    }
}
