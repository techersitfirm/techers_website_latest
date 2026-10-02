<?php

namespace app\models;

use app\core\Database;
use PDO;
use Throwable;

class BlogModel
{
    private PDO $db;

    /*
     * Change this if your actual page master table
     * has a different name.
     */
    private string $pageTable = 'master_page_tbl';

    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    /**
     * ---------------------------------------------------------
     * Get all blogs
     * ---------------------------------------------------------
     */
    public function getAll(): array
    {
        $stmt = $this->db->query("
            SELECT
                b.id,
                b.page_id,
                b.title,
                b.slug,
                b.description,
                b.intro_image,
                b.blog_date,
                b.views_count,
                b.popular_tags,
                b.author,
                b.created_by,
                b.is_delete,
                b.is_active,
                b.created_at,
                b.updated_at,

                p.name AS page_name,
                p.is_active AS page_is_active

            FROM blogs b

            LEFT JOIN master_page_tbl p
                ON p.id = b.page_id

            WHERE b.is_delete = 0

            ORDER BY b.id DESC
        ");

        return $stmt->fetchAll();
    }


    /**
     * ---------------------------------------------------------
     * Find blog by ID
     * ---------------------------------------------------------
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT
                b.*,

                p.name AS page_name,
                p.slug AS page_slug,
                p.title AS seo_page_title,
                p.header_heading,
                p.header_sub_heading,
                p.meta_tag,
                p.meta_keyword,
                p.seo_title,
                p.seo_description,
                p.seo_canonical,
                p.seo_robots,
                p.og_title,
                p.og_description,
                p.og_image,
                p.faq_scripts,
                p.is_active AS page_is_active,
                p.is_child,
                p.modify_by

            FROM blogs b

            LEFT JOIN master_page_tbl p
                ON p.id = b.page_id

            WHERE b.id = ?
            AND b.is_delete = 0

            LIMIT 1
        ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }


    /**
     * ---------------------------------------------------------
     * Find blog by slug
     * ---------------------------------------------------------
     */
    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare("
            SELECT
                b.*,

                p.name AS page_name,
                p.is_active AS page_is_active,
                p.is_child

            FROM blogs b

            LEFT JOIN master_page_tbl p
                ON p.id = b.page_id

            WHERE b.slug = ?
            AND b.is_delete = 0

            LIMIT 1
        ");

        $stmt->execute([$slug]);

        return $stmt->fetch() ?: null;
    }


    /**
     * ---------------------------------------------------------
     * Check slug exists
     * ---------------------------------------------------------
     */
    public function slugExists(
        string $slug,
        ?int $excludeBlogId = null
    ): bool {

        $sql = "
            SELECT id
            FROM blogs
            WHERE slug = ?
            AND is_delete = 0
        ";

        $params = [$slug];

        if ($excludeBlogId !== null) {
            $sql .= " AND id != ?";
            $params[] = $excludeBlogId;
        }

        $sql .= " LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (bool) $stmt->fetch();
    }


    /**
     * ---------------------------------------------------------
     * Check page slug exists
     * ---------------------------------------------------------
     */
    public function pageSlugExists(
        string $slug,
        ?int $excludePageId = null
    ): bool {

        $sql = "
            SELECT id
            FROM master_page_tbl
            WHERE slug = ?
        ";

        $params = [$slug];

        if ($excludePageId !== null) {
            $sql .= " AND id != ?";
            $params[] = $excludePageId;
        }

        $sql .= " LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (bool) $stmt->fetch();
    }


    /**
     * ---------------------------------------------------------
     * Create Blog
     *
     * Creates:
     * 1. Page master record
     * 2. Blog record
     *
     * Both are handled in one transaction.
     * ---------------------------------------------------------
     */
    public function create(array $data): ?int
    {
        try {

            $this->db->beginTransaction();


            /*
             * Generate slug.
             */
            $slug = $this->generateUniqueSlug(
                $data['title']
            );


            /*
             * -------------------------------------------------
             * Create Page Master
             * -------------------------------------------------
             *
             * Blogs are child pages.
             */
            $pageStmt = $this->db->prepare("
                INSERT INTO master_page_tbl
                (
                    name,
                    slug,
                    title,
                    header_heading,
                    header_sub_heading,
                    meta_tag,
                    meta_keyword,
                    seo_title,
                    seo_description,
                    seo_canonical,
                    seo_robots,
                    og_title,
                    og_description,
                    og_image,
                    faq_scripts,
                    is_active,
                    is_child,
                    modify_by,
                    created_at
                )
                VALUES
                (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, NOW()
                )
            ");

            $pageStmt->execute([
                $data['title'],
                $slug,

                /*
                 * SEO fields.
                 * These can be populated later from the SEO form.
                 */
                $data['seo_title'] ?? null,
                $data['header_heading'] ?? null,
                $data['header_sub_heading'] ?? null,
                $data['meta_tag'] ?? null,
                $data['meta_keyword'] ?? null,
                $data['seo_title'] ?? null,
                $data['seo_description'] ?? null,
                $data['seo_canonical'] ?? null,
                $data['seo_robots'] ?? null,
                $data['og_title'] ?? null,
                $data['og_description'] ?? null,
                $data['og_image'] ?? null,
                $data['faq_scripts'] ?? null,

                $data['is_active'] ?? 1,
                $data['created_by'] ?? null
            ]);


            $pageId = (int) $this->db->lastInsertId();


            /*
             * -------------------------------------------------
             * Create Blog
             * -------------------------------------------------
             */
            $blogStmt = $this->db->prepare("
                INSERT INTO blogs
                (
                    page_id,
                    title,
                    slug,
                    description,
                    intro_image,
                    blog_date,
                    views_count,
                    popular_tags,
                    author,
                    created_by,
                    is_delete,
                    is_active,
                    created_at
                )
                VALUES
                (
                    ?, ?, ?, ?, ?, ?, 0, ?, ?, ?, 0, ?, NOW()
                )
            ");

            $blogStmt->execute([
                $pageId,
                $data['title'],
                $slug,
                $data['description'],
                $data['intro_image'] ?? null,
                $data['blog_date'],
                $data['popular_tags'] ?? null,
                $data['author'] ?? null,
                $data['created_by'] ?? null,
                $data['is_active'] ?? 1
            ]);


            $blogId = (int) $this->db->lastInsertId();


            $this->db->commit();

            return $blogId;

        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }


    /**
     * ---------------------------------------------------------
     * Modify / Update Blog
     *
     * Updates both:
     * - blogs
     * - master_page_tbl
     * ---------------------------------------------------------
     */
    public function update(int $id, array $data): bool
    {
        try {

            $this->db->beginTransaction();


            /*
             * Get existing blog.
             */
            $blog = $this->findById($id);

            if (!$blog) {

                $this->db->rollBack();

                return false;
            }


            $pageId = (int) $blog['page_id'];


            /*
             * -------------------------------------------------
             * Slug
             * -------------------------------------------------
             *
             * Generate a new slug only when requested.
             */
            $slug = $data['slug'] ?? $blog['slug'];

            if (empty($slug)) {

                $slug = $this->generateUniqueSlug(
                    $data['title'],
                    $id
                );
            }


            /*
             * -------------------------------------------------
             * Update Page Master
             * -------------------------------------------------
             */
            $pageStmt = $this->db->prepare("
                UPDATE master_page_tbl
                SET
                    name = ?,
                    slug = ?,
                    title = ?,
                    header_heading = ?,
                    header_sub_heading = ?,
                    meta_tag = ?,
                    meta_keyword = ?,
                    seo_title = ?,
                    seo_description = ?,
                    seo_canonical = ?,
                    seo_robots = ?,
                    og_title = ?,
                    og_description = ?,
                    og_image = ?,
                    faq_scripts = ?,
                    is_active = ?,
                    is_child = 1,
                    modify_by = ?,
                    updated_at = NOW()

                WHERE id = ?
            ");

            $pageStmt->execute([
                $data['title'],
                $slug,
                $data['seo_title'] ?? null,
                $data['header_heading'] ?? null,
                $data['header_sub_heading'] ?? null,
                $data['meta_tag'] ?? null,
                $data['meta_keyword'] ?? null,
                $data['seo_title'] ?? null,
                $data['seo_description'] ?? null,
                $data['seo_canonical'] ?? null,
                $data['seo_robots'] ?? null,
                $data['og_title'] ?? null,
                $data['og_description'] ?? null,
                $data['og_image'] ?? null,
                $data['faq_scripts'] ?? null,
                $data['is_active'] ?? 1,
                $data['updated_by'] ?? null,
                $pageId
            ]);


            /*
             * -------------------------------------------------
             * Update Blog
             * -------------------------------------------------
             */
            $sql = "
                UPDATE blogs
                SET
                    title = ?,
                    slug = ?,
                    description = ?,
                    blog_date = ?,
                    popular_tags = ?,
                    author = ?,
                    is_active = ?,
                    updated_at = NOW()
            ";

            $params = [
                $data['title'],
                $slug,
                $data['description'],
                $data['blog_date'],
                $data['popular_tags'] ?? null,
                $data['author'] ?? null,
                $data['is_active'] ?? 1
            ];


            /*
             * Update image only when a new image
             * has been uploaded.
             */
            if (
                isset($data['intro_image']) &&
                $data['intro_image'] !== ''
            ) {

                $sql .= ",
                    intro_image = ?
                ";

                $params[] = $data['intro_image'];
            }


            $sql .= "
                WHERE id = ?
                AND is_delete = 0
            ";

            $params[] = $id;


            $blogStmt = $this->db->prepare($sql);

            $blogStmt->execute($params);


            $this->db->commit();

            return true;

        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }


    /**
     * ---------------------------------------------------------
     * Toggle Blog Status
     *
     * Blog and page master status stay synchronized.
     * ---------------------------------------------------------
     */
    public function toggleStatus(int $id): bool
    {
        try {

            $this->db->beginTransaction();


            /*
             * Get blog/page relation.
             */
            $stmt = $this->db->prepare("
                SELECT
                    id,
                    page_id,
                    is_active
                FROM blogs
                WHERE id = ?
                AND is_delete = 0
                LIMIT 1
            ");

            $stmt->execute([$id]);

            $blog = $stmt->fetch();

            if (!$blog) {

                $this->db->rollBack();

                return false;
            }


            /*
             * Toggle blog status.
             */
            $newStatus =
                ((int) $blog['is_active'] === 1)
                    ? 0
                    : 1;


            $blogStmt = $this->db->prepare("
                UPDATE blogs
                SET
                    is_active = ?,
                    updated_at = NOW()
                WHERE id = ?
                AND is_delete = 0
            ");

            $blogStmt->execute([
                $newStatus,
                $id
            ]);


            /*
             * Keep page master status synchronized.
             */
            $pageStmt = $this->db->prepare("
                UPDATE master_page_tbl
                SET
                    is_active = ?,
                    updated_at = NOW()
                WHERE id = ?
            ");

            $pageStmt->execute([
                $newStatus,
                (int) $blog['page_id']
            ]);


            $this->db->commit();

            return true;

        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }


    /**
     * ---------------------------------------------------------
     * Delete Blog
     *
     * Soft delete.
     * ---------------------------------------------------------
     */
    public function delete(int $id): bool
    {
        try {

            $this->db->beginTransaction();


            /*
             * Get page ID first.
             */
            $stmt = $this->db->prepare("
                SELECT page_id
                FROM blogs
                WHERE id = ?
                AND is_delete = 0
                LIMIT 1
            ");

            $stmt->execute([$id]);

            $blog = $stmt->fetch();

            if (!$blog) {

                $this->db->rollBack();

                return false;
            }


            /*
             * Soft delete blog.
             */
            $blogStmt = $this->db->prepare("
                UPDATE blogs
                SET
                    is_delete = 1,
                    is_active = 0,
                    updated_at = NOW()
                WHERE id = ?
                AND is_delete = 0
            ");

            $blogStmt->execute([$id]);


            /*
             * Deactivate related page.
             *
             * We don't physically delete it because
             * SEO/page information may still be useful.
             */
            $pageStmt = $this->db->prepare("
                UPDATE master_page_tbl
                SET
                    is_active = 0,
                    updated_at = NOW()
                WHERE id = ?
            ");

            $pageStmt->execute([
                (int) $blog['page_id']
            ]);


            $this->db->commit();

            return true;

        } catch (Throwable $e) {

            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $e;
        }
    }


    /**
     * ---------------------------------------------------------
     * Increment Views Count
     * ---------------------------------------------------------
     */
    public function incrementViews(int $id): bool
    {
        $stmt = $this->db->prepare("
            UPDATE blogs
            SET views_count = views_count + 1
            WHERE id = ?
            AND is_delete = 0
            AND is_active = 1
        ");

        return $stmt->execute([$id]);
    }


    /**
     * ---------------------------------------------------------
     * Generate Unique Slug
     * ---------------------------------------------------------
     */
    private function generateUniqueSlug(
        string $title,
        ?int $excludeBlogId = null
    ): string {

        $baseSlug = $this->slugify($title);

        if ($baseSlug === '') {
            $baseSlug = 'blog';
        }

        $slug = $baseSlug;
        $counter = 1;


        while ($this->slugExists($slug, $excludeBlogId)) {

            $slug = $baseSlug . '-' . $counter;

            $counter++;
        }


        /*
         * Also ensure the page master doesn't
         * already contain the same slug.
         */
        $pageCounter = 1;
        $pageSlug = $slug;

        while (
            $this->pageSlugExists(
                $pageSlug,
                null
            )
        ) {

            /*
             * If this is the existing page belonging
             * to the same blog, it is allowed.
             */
            if (
                $excludeBlogId !== null
            ) {

                $stmt = $this->db->prepare("
                    SELECT page_id
                    FROM blogs
                    WHERE id = ?
                    LIMIT 1
                ");

                $stmt->execute([
                    $excludeBlogId
                ]);

                $existing = $stmt->fetch();

                if (
                    $existing &&
                    $this->pageSlugBelongsToPage(
                        $pageSlug,
                        (int) $existing['page_id']
                    )
                ) {
                    return $pageSlug;
                }
            }


            $pageSlug =
                $baseSlug . '-' . $counter;

            $counter++;
        }


        return $pageSlug;
    }


    /**
     * ---------------------------------------------------------
     * Check whether page slug belongs to specific page
     * ---------------------------------------------------------
     */
    private function pageSlugBelongsToPage(
        string $slug,
        int $pageId
    ): bool {

        $stmt = $this->db->prepare("
            SELECT id
            FROM master_page_tbl
            WHERE slug = ?
            AND id = ?
            LIMIT 1
        ");

        $stmt->execute([
            $slug,
            $pageId
        ]);

        return (bool) $stmt->fetch();
    }


    /**
     * ---------------------------------------------------------
     * Slugify
     * ---------------------------------------------------------
     */
    private function slugify(string $text): string
    {
        $text = trim($text);

        $text = strtolower($text);

        $text = preg_replace(
            '/[^a-z0-9]+/',
            '-',
            $text
        );

        $text = trim(
            $text,
            '-'
        );

        return $text;
    }
}
