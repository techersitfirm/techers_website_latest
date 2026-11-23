<?php

namespace app\controllers\Admin;

use app\core\Controller;
use app\core\Flash;
use app\helpers\Crypto;
use app\helpers\Csrf;
use app\middleware\AdminAuthMiddleware;
use app\models\TestimonialModel;

class TestimonialController extends Controller
{
    private TestimonialModel $testimonialModel;

    public function __construct()
    {
        $this->testimonialModel = new TestimonialModel();
    }

    /**
     * Testimonial listing
     */
    public function index(): void
    {
        AdminAuthMiddleware::handle('testimonial.view');

        $testimonials = $this->testimonialModel->getAll();

        foreach ($testimonials as &$testimonial) {
            $testimonial['token'] = Crypto::encryptId(
                (int) $testimonial['ID']
            );
        }

        unset($testimonial);

        $this->renderAdmin('testimonials/index', [
            'pageTitle' => 'Testimonials',
            'testimonials' => $testimonials
        ]);
    }

    /**
     * Create testimonial page
     */
    public function create(): void
    {
        AdminAuthMiddleware::handle('testimonial.create');

        $this->renderAdmin('testimonials/create', [
            'pageTitle' => 'Add Testimonial'
        ]);
    }

    /**
     * Store testimonial
     */
    public function store(): void
    {
        AdminAuthMiddleware::handle('testimonial.create');

        $redirect = BASE_URL . '/admin/testimonials/create';

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid security token.');
            $this->redirect($redirect);
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'type' => trim($_POST['type'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'status' => isset($_POST['status']) ? 1 : 0
        ];

        if ($data['name'] === '') {
            Flash::error('Testimonial name is required.');
            $this->redirect($redirect);
        }

        if ($data['type'] === '') {
            Flash::error('Testimonial type is required.');
            $this->redirect($redirect);
        }

        if ($data['content'] === '') {
            Flash::error('Testimonial content is required.');
            $this->redirect($redirect);
        }

        if (
            !isset($_FILES['image']) ||
            $_FILES['image']['error'] !== UPLOAD_ERR_OK
        ) {
            Flash::error('Testimonial image is required.');
            $this->redirect($redirect);
        }

        $image = $this->uploadTestimonialImage(
            $_FILES['image'],
            $redirect
        );

        $data['ProfilePic'] = $image;

        $this->testimonialModel->create($data);

        Flash::success('Testimonial added successfully.');

        $this->redirect(
            BASE_URL . '/admin/testimonials'
        );
    }

    /**
     * Edit testimonial
     */
    public function edit(): void
    {
        AdminAuthMiddleware::handle('testimonial.edit');

        $token = $_GET['token'] ?? '';

        $id = Crypto::decryptId($token);

        if (!$id) {
            require VIEW_PATH . '/errors/404.php';
            exit;
        }

        $testimonial = $this->testimonialModel->findById(
            (int) $id
        );

        if (!$testimonial) {
            require VIEW_PATH . '/errors/404.php';
            exit;
        }

        $testimonial['token'] = Crypto::encryptId(
            (int) $testimonial['ID']
        );

        $this->renderAdmin('testimonials/edit', [
            'pageTitle' => 'Edit Testimonial',
            'testimonial' => $testimonial
        ]);
    }

    /**
     * Update testimonial
     */
    public function update(): void
    {
        AdminAuthMiddleware::handle('testimonial.edit');

        $token = $_POST['token'] ?? '';

        $id = Crypto::decryptId($token);

        $redirect = BASE_URL . '/admin/testimonials';

        if (!$id) {
            Flash::error('Invalid testimonial.');
            $this->redirect($redirect);
        }

        $testimonial = $this->testimonialModel->findById(
            (int) $id
        );

        if (!$testimonial) {
            Flash::error('Testimonial not found.');
            $this->redirect($redirect);
        }

        $redirect = BASE_URL
            . '/admin/testimonials/edit?token='
            . urlencode($token);

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid security token.');
            $this->redirect($redirect);
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'type' => trim($_POST['type'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'status' => isset($_POST['status']) ? 1 : 0
        ];

        if ($data['name'] === '') {
            Flash::error('Testimonial name is required.');
            $this->redirect($redirect);
        }

        if ($data['type'] === '') {
            Flash::error('Testimonial type is required.');
            $this->redirect($redirect);
        }

        if ($data['content'] === '') {
            Flash::error('Testimonial content is required.');
            $this->redirect($redirect);
        }

        if (
            isset($_FILES['image']) &&
            $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            $data['ProfilePic'] = $this->uploadTestimonialImage(
                $_FILES['image'],
                $redirect
            );
        }

        $this->testimonialModel->update(
            (int) $id,
            $data
        );

        Flash::success('Testimonial updated successfully.');

        $this->redirect(
            BASE_URL . '/admin/testimonials'
        );
    }

    /**
     * Toggle testimonial status
     */
    public function toggleStatus(): void
    {
        AdminAuthMiddleware::handle('testimonial.remove');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid security token.');

            $this->redirect(
                BASE_URL . '/admin/testimonials'
            );
        }

        $token = $_POST['token'] ?? '';

        $id = Crypto::decryptId($token);

        if (!$id) {
            Flash::error('Invalid testimonial.');

            $this->redirect(
                BASE_URL . '/admin/testimonials'
            );
        }

        if (
            $this->testimonialModel->toggleStatus((int) $id)
        ) {
            Flash::success(
                'Testimonial status updated successfully.'
            );
        } else {
            Flash::error(
                'Unable to update testimonial status.'
            );
        }

        $this->redirect(
            BASE_URL . '/admin/testimonials'
        );
    }

    /**
     * Delete testimonial
     */
    public function delete(): void
    {
        AdminAuthMiddleware::handle('testimonial.delete');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid security token.');

            $this->redirect(
                BASE_URL . '/admin/testimonials'
            );
        }

        $token = $_POST['token'] ?? '';

        $id = Crypto::decryptId($token);

        if (!$id) {
            Flash::error('Invalid testimonial.');

            $this->redirect(
                BASE_URL . '/admin/testimonials'
            );
        }

        if (
            $this->testimonialModel->delete((int) $id)
        ) {
            Flash::success(
                'Testimonial deleted successfully.'
            );
        } else {
            Flash::error(
                'Unable to delete testimonial.'
            );
        }

        $this->redirect(
            BASE_URL . '/admin/testimonials'
        );
    }

    /**
     * Upload testimonial image
     *
     * Physical:
     * public/testimonials/<filename>
     *
     * Database:
     * testimonials/<filename>
     */
    private function uploadTestimonialImage(
        array $image,
        string $redirect
    ): string {
        if (
            !isset($image['error']) ||
            $image['error'] !== UPLOAD_ERR_OK
        ) {
            Flash::error('Unable to upload testimonial image.');
            $this->redirect($redirect);
        }

        if (($image['size'] ?? 0) > 2 * 1024 * 1024) {
            Flash::error(
                'Testimonial image must not exceed 2 MB.'
            );
            $this->redirect($redirect);
        }

        $tmpName = $image['tmp_name'] ?? '';

        if (!is_uploaded_file($tmpName)) {
            Flash::error('Invalid testimonial image upload.');
            $this->redirect($redirect);
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);

        $mime = $finfo->file($tmpName);

        $allowedMimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($allowedMimeTypes[$mime])) {
            Flash::error(
                'Only JPG, PNG and WEBP images are allowed.'
            );
            $this->redirect($redirect);
        }

        if (@getimagesize($tmpName) === false) {
            Flash::error('Invalid testimonial image.');
            $this->redirect($redirect);
        }

        $extension = $allowedMimeTypes[$mime];

        $directory = PUBLIC_PATH . '/testimonials/';

        if (!is_dir($directory)) {
            if (
                !mkdir($directory, 0755, true) &&
                !is_dir($directory)
            ) {
                Flash::error(
                    'Unable to create testimonial upload directory.'
                );
                $this->redirect($redirect);
            }
        }

        $fileName = 'testimonial-'
            . date('YmdHis')
            . '-'
            . bin2hex(random_bytes(4))
            . '.'
            . $extension;

        $destination = $directory . $fileName;

        if (
            !move_uploaded_file(
                $tmpName,
                $destination
            )
        ) {
            Flash::error(
                'Unable to save testimonial image.'
            );
            $this->redirect($redirect);
        }

        return 'testimonials/' . $fileName;
    }
}