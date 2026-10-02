<?php

namespace app\controllers\Admin;

use app\core\Controller;
use app\core\Flash;
use app\helpers\Crypto;
use app\helpers\Csrf;
use app\middleware\AdminAuthMiddleware;
use app\models\ProjectModel;

class ProjectController extends Controller
{
    private ProjectModel $projectModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
    }

    /**
     * ---------------------------------------------------------
     * Project List
     * ---------------------------------------------------------
     */
    public function index(): void
    {
        AdminAuthMiddleware::handle('project.view');

        $projects = $this->projectModel->getAll();

        /*
         * Generate encrypted token for each project.
         */
        foreach ($projects as &$project) {

            $project['token'] = Crypto::encryptId(
                (int) $project['ID']
            );
        }

        unset($project);

        $this->renderAdmin('projects/index', [
            'pageTitle' => 'Project Management',
            'projects' => $projects
        ]);
    }

    /**
     * ---------------------------------------------------------
     * Create Project
     * ---------------------------------------------------------
     */
    public function create(): void
    {
        AdminAuthMiddleware::handle('project.create');

        $this->renderAdmin('projects/create', [
            'pageTitle' => 'Add Project'
        ]);
    }

    /**
     * ---------------------------------------------------------
     * Store Project
     * ---------------------------------------------------------
     */
    public function store(): void
    {
        AdminAuthMiddleware::handle('project.create');

        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/projects/create'
            );
        }

        $redirect =
            BASE_URL . '/admin/projects/create';

        /*
         * Request data
         */
        $name =
            trim($_POST['name'] ?? '');

        $projectType =
            trim($_POST['project_type'] ?? '');

        $link =
            trim($_POST['link'] ?? '');

        $status =
            isset($_POST['status'])
                ? 1
                : 0;

        /*
         * Validation
         */
        if ($name === '') {

            Flash::error(
                'Project name is required.'
            );

            $this->redirect($redirect);
        }

        if ($projectType === '') {

            Flash::error(
                'Project type is required.'
            );

            $this->redirect($redirect);
        }

        /*
         * Image required
         */
        if (
            !isset($_FILES['image']) ||
            $_FILES['image']['error'] !== UPLOAD_ERR_OK
        ) {

            Flash::error(
                'Project image is required.'
            );

            $this->redirect($redirect);
        }

        /*
         * Upload image
         */
        $image =
            $this->uploadProjectImage(
                $_FILES['image'],
                $redirect
            );

        /*
         * Create project
         */
        $projectId =
            $this->projectModel->create([
                'name' => $name,
                'project_type' => $projectType,
                'ProfilePic' => $image,
                'status' => $status,
                'link' => $link
            ]);

        if (!$projectId) {

            Flash::error(
                'Unable to create project.'
            );

            $this->redirect($redirect);
        }

        Flash::success(
            'Project added successfully.'
        );

        $this->redirect(
            BASE_URL . '/admin/projects'
        );
    }

    /**
     * ---------------------------------------------------------
     * Edit Project
     * ---------------------------------------------------------
     */
    public function edit(): void
    {
        AdminAuthMiddleware::handle('project.edit');

        /*
         * Decrypt token
         */
        $id =
            Crypto::decryptId(
                $_GET['token'] ?? ''
            );

        if (!$id) {

            http_response_code(404);

            require VIEW_PATH . '/errors/404.php';

            exit;
        }

        /*
         * Find project
         */
        $project =
            $this->projectModel->findById(
                $id
            );

        if (!$project) {

            http_response_code(404);

            require VIEW_PATH . '/errors/404.php';

            exit;
        }

        /*
         * Generate token again for form.
         */
        $project['token'] =
            Crypto::encryptId(
                (int) $project['ID']
            );

        $this->renderAdmin('projects/edit', [
            'pageTitle' => 'Edit Project',
            'project' => $project
        ]);
    }

    /**
     * ---------------------------------------------------------
     * Update Project
     * ---------------------------------------------------------
     */
    public function update(): void
    {
        AdminAuthMiddleware::handle('project.edit');

        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/projects'
            );
        }

        /*
         * Decrypt token
         */
        $token =
            $_POST['token'] ?? '';

        $id =
            Crypto::decryptId($token);

        if (!$id) {

            Flash::error(
                'Invalid project.'
            );

            $this->redirect(
                BASE_URL . '/admin/projects'
            );
        }

        /*
         * Existing project
         */
        $project =
            $this->projectModel->findById(
                $id
            );

        if (!$project) {

            Flash::error(
                'Project not found.'
            );

            $this->redirect(
                BASE_URL . '/admin/projects'
            );
        }

        /*
         * Redirect back to edit page
         */
        $redirect =
            BASE_URL .
            '/admin/projects/edit?token=' .
            urlencode($token);

        /*
         * Request data
         */
        $name =
            trim($_POST['name'] ?? '');

        $projectType =
            trim($_POST['project_type'] ?? '');

        $link =
            trim($_POST['link'] ?? '');

        $status =
            isset($_POST['status'])
                ? 1
                : 0;

        /*
         * Validation
         */
        if ($name === '') {

            Flash::error(
                'Project name is required.'
            );

            $this->redirect($redirect);
        }

        if ($projectType === '') {

            Flash::error(
                'Project type is required.'
            );

            $this->redirect($redirect);
        }

        /*
         * Existing image
         */
        $data = [
            'name' => $name,
            'project_type' => $projectType,
            'status' => $status,
            'link' => $link,
            'ProfilePic' => $project['ProfilePic'] ?? null
        ];

        /*
         * New image uploaded?
         */
        if (
            isset($_FILES['image']) &&
            $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $data['ProfilePic'] =
                $this->uploadProjectImage(
                    $_FILES['image'],
                    $redirect
                );
        }

        /*
         * Update
         */
        if (
            !$this->projectModel->update(
                (int) $id,
                $data
            )
        ) {

            Flash::error(
                'Unable to update project.'
            );

            $this->redirect($redirect);
        }

        Flash::success(
            'Project updated successfully.'
        );

        $this->redirect(
            BASE_URL . '/admin/projects'
        );
    }

    /**
     * ---------------------------------------------------------
     * Toggle Project Status
     * ---------------------------------------------------------
     */
    public function toggleStatus(): void
    {
        AdminAuthMiddleware::handle('project.remove');

        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/projects'
            );
        }

        /*
         * Decrypt project ID
         */
        $id =
            Crypto::decryptId(
                $_POST['token'] ?? ''
            );

        if (!$id) {

            Flash::error(
                'Invalid project.'
            );

            $this->redirect(
                BASE_URL . '/admin/projects'
            );
        }

        /*
         * Toggle
         */
        $result =
            $this->projectModel->toggleStatus(
                $id
            );

        if ($result) {

            Flash::success(
                'Project status updated successfully.'
            );

        } else {

            Flash::error(
                'Unable to update project status.'
            );
        }

        $this->redirect(
            BASE_URL . '/admin/projects'
        );
    }

    /**
     * ---------------------------------------------------------
     * Delete Project
     * ---------------------------------------------------------
     */
    public function delete(): void
    {
        AdminAuthMiddleware::handle('project.delete');

        /*
        * CSRF
        */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/projects'
            );
        }

        /*
        * Decrypt project ID
        */
        $id =
            Crypto::decryptId(
                $_POST['token'] ?? ''
            );

        if (!$id) {

            Flash::error(
                'Invalid project.'
            );

            $this->redirect(
                BASE_URL . '/admin/projects'
            );
        }

        /*
        * Delete
        */
        $result =
            $this->projectModel->delete(
                $id
            );

        if ($result) {

            Flash::success(
                'Project deleted successfully.'
            );

        } else {

            Flash::error(
                'Unable to delete project.'
            );
        }

        $this->redirect(
            BASE_URL . '/admin/projects'
        );
    }

    /**
     * ---------------------------------------------------------
     * Upload Project Image
     * ---------------------------------------------------------
     */
    private function uploadProjectImage(array $image, string $redirect): string
    {
        if ($image['error'] !== UPLOAD_ERR_OK) {
            Flash::error('Unable to upload project image.');
            $this->redirect($redirect);
        }

        if ($image['size'] > 2 * 1024 * 1024) {
            Flash::error('Project image must not exceed 2 MB.');
            $this->redirect($redirect);
        }

        $mime = (new \finfo(FILEINFO_MIME_TYPE))
            ->file($image['tmp_name']);

        $allowedMimes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!in_array($mime, $allowedMimes, true)) {
            Flash::error('Only JPG, PNG and WebP images are allowed.');
            $this->redirect($redirect);
        }

        if (!@getimagesize($image['tmp_name'])) {
            Flash::error('Invalid project image.');
            $this->redirect($redirect);
        }

        $extension = match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
            default      => null
        };

        if (!$extension) {
            Flash::error('Invalid image format.');
            $this->redirect($redirect);
        }

        $fileName = 'project_'
            . random_int(100000, 999999)
            . '_'
            . hrtime(true)
            . '.'
            . $extension;

        // Actual filesystem path:
        // public/projects/
        $directory = PUBLIC_PATH . '/projects/';

        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true) && !is_dir($directory)) {
                Flash::error('Unable to create project image directory.');
                $this->redirect($redirect);
            }
        }

        $destination = $directory . $fileName;

        if (!move_uploaded_file($image['tmp_name'], $destination)) {
            Flash::error('Unable to save project image.');
            $this->redirect($redirect);
        }

        // Store relative path in database
        return 'projects/' . $fileName;
    }
}