<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class JobsModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all jobs
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT
                id,
                title,
                job_location,
                qualification,
                job_brief,
                roll_skill,
                image,
                job_date,
                perks_benefits,
                requirements,
                status
            FROM jobs
            ORDER BY id DESC
        ");

        return $stmt->fetchAll();
    }

    /**
     * Find job by ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT
                id,
                title,
                job_location,
                qualification,
                job_brief,
                roll_skill,
                image,
                job_date,
                perks_benefits,
                requirements,
                status
            FROM jobs
            WHERE id = ?
            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Create job
     */
    public function create(array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO jobs
            (
                title,
                job_location,
                qualification,
                job_brief,
                roll_skill,
                image,
                job_date,
                perks_benefits,
                requirements,
                status
            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ");

        $stmt->execute([
            $data['title'],
            $data['job_location'],
            $data['qualification'],
            $data['job_brief'],
            $data['roll_skill'],
            $data['image'],
            $data['job_date'],
            $data['perks_benefits'],
            $data['requirements'],
            $data['status']
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Update job
     */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE jobs
            SET
                title = ?,
                job_location = ?,
                qualification = ?,
                job_brief = ?,
                roll_skill = ?,
                image = ?,
                job_date = ?,
                perks_benefits = ?,
                requirements = ?,
                status = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $data['title'],
            $data['job_location'],
            $data['qualification'],
            $data['job_brief'],
            $data['roll_skill'],
            $data['image'],
            $data['job_date'],
            $data['perks_benefits'],
            $data['requirements'],
            $data['status'],
            $id
        ]);
    }

    /**
     * Toggle job status
     */
    public function toggleStatus(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE jobs
            SET
                status = IF(status = 1, 0, 1)
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    /**
     * Delete job
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM jobs
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }
}