<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Flash;
use App\Helpers\Crypto;
use App\Helpers\Csrf;
use App\Middleware\AdminAuthMiddleware;
use App\Models\BlogModel;

class BlogController extends Controller
{
    private BlogModel $blogModel;


    public function __construct()
    {
        $this->blogModel = new BlogModel();
    }


    /**
     * ---------------------------------------------------------
     * Blog List
     * ---------------------------------------------------------
     */
    public function index(): void
    {
        AdminAuthMiddleware::handle('blog.view');

        $blogs = $this->blogModel->getAll();

        /*
         * Generate encrypted token for each blog.
         */
        foreach ($blogs as &$blog) {

            $blog['token'] = Crypto::encryptId(
                (int) $blog['id']
            );
        }

        unset($blog);


        $this->renderAdmin('blogs/index', [
            'pageTitle' => 'Blog Management',
            'blogs' => $blogs
        ]);
    }


    /**
     * ---------------------------------------------------------
     * Create Blog
     * ---------------------------------------------------------
     */
    public function create(): void
    {
        AdminAuthMiddleware::handle('blog.create');

        $this->renderAdmin('blogs/create', [
            'pageTitle' => 'Add Blog'
        ]);
    }


    /**
     * ---------------------------------------------------------
     * Store Blog
     * ---------------------------------------------------------
     */
    public function store(): void
    {
        AdminAuthMiddleware::handle('blog.create');


        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/blogs/create'
            );
        }


        $redirect = BASE_URL . '/admin/blogs/create';


        /*
         * Request data
         */
        $data = $this->requestData();


        /*
         * Validation
         */
        $validation = $this->validateData($data);

        if ($validation !== null) {

            Flash::error($validation);

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
                'Blog image is required.'
            );

            $this->redirect($redirect);
        }


        /*
         * Upload image
         */
        $data['intro_image'] =
            $this->uploadBlogImage(
                $_FILES['image'],
                $redirect
            );


        /*
         * Logged-in user
         */
        $data['created_by'] =
            $_SESSION['user_id'] ?? null;


        /*
         * Create blog
         *
         * BlogModel will create:
         * - master_page
         * - blogs
         *
         * and connect them using page_id.
         */
        $blogId = $this->blogModel->create($data);


        if (!$blogId) {

            Flash::error(
                'Unable to create blog.'
            );

            $this->redirect($redirect);
        }


        Flash::success(
            'Blog added successfully.'
        );


        $this->redirect(
            BASE_URL . '/admin/blogs'
        );
    }


    /**
     * ---------------------------------------------------------
     * Edit Blog
     * ---------------------------------------------------------
     */
    public function edit(): void
    {
        AdminAuthMiddleware::handle('blog.edit');


        /*
         * Decrypt token
         */
        $id = Crypto::decryptId(
            $_GET['token'] ?? ''
        );


        if (!$id) {

            http_response_code(404);

            require VIEW_PATH . '/errors/404.php';

            exit;
        }


        /*
         * Find blog
         */
        $blog = $this->blogModel->findById($id);


        if (!$blog) {

            http_response_code(404);

            require VIEW_PATH . '/errors/404.php';

            exit;
        }


        /*
         * Generate token again for the form.
         */
        $blog['token'] = Crypto::encryptId(
            (int) $blog['id']
        );


        $this->renderAdmin('blogs/edit', [
            'pageTitle' => 'Edit Blog',
            'blog' => $blog
        ]);
    }


    /**
     * ---------------------------------------------------------
     * Update Blog
     * ---------------------------------------------------------
     */
    public function update(): void
    {
        AdminAuthMiddleware::handle('blog.edit');


        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/blogs'
            );
        }


        /*
         * Decrypt token
         */
        $token = $_POST['token'] ?? '';

        $id = Crypto::decryptId($token);


        if (!$id) {

            Flash::error(
                'Invalid blog.'
            );

            $this->redirect(
                BASE_URL . '/admin/blogs'
            );
        }


        /*
         * Existing blog
         */
        $blog = $this->blogModel->findById($id);


        if (!$blog) {

            Flash::error(
                'Blog not found.'
            );

            $this->redirect(
                BASE_URL . '/admin/blogs'
            );
        }


        /*
         * Redirect back to edit page
         */
        $redirect =
            BASE_URL .
            '/admin/blogs/edit?token=' .
            urlencode($token);


        /*
         * Request data
         */
        $data = $this->requestData();


        /*
         * Validation
         */
        $validation = $this->validateData($data);

        if ($validation !== null) {

            Flash::error($validation);

            $this->redirect($redirect);
        }


        /*
         * Existing image
         */
        $data['intro_image'] =
            $blog['intro_image'] ?? null;


        /*
         * New image uploaded?
         */
        if (
            isset($_FILES['image']) &&
            $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $data['intro_image'] =
                $this->uploadBlogImage(
                    $_FILES['image'],
                    $redirect
                );
        }


        /*
         * Logged-in user
         */
        $data['updated_by'] =
            $_SESSION['user_id'] ?? null;


        /*
         * Update
         */
        if (
            !$this->blogModel->update(
                $id,
                $data
            )
        ) {

            Flash::error(
                'Unable to update blog.'
            );

            $this->redirect($redirect);
        }


        Flash::success(
            'Blog updated successfully.'
        );


        $this->redirect(
            BASE_URL . '/admin/blogs'
        );
    }


    /**
     * ---------------------------------------------------------
     * Toggle Blog Status
     * ---------------------------------------------------------
     */
    public function toggleStatus(): void
    {
        AdminAuthMiddleware::handle('blog.remove');


        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/blogs'
            );
        }


        /*
         * Decrypt blog ID
         */
        $id = Crypto::decryptId(
            $_POST['token'] ?? ''
        );


        if (!$id) {

            Flash::error(
                'Invalid blog.'
            );

            $this->redirect(
                BASE_URL . '/admin/blogs'
            );
        }


        /*
         * Toggle
         */
        $result =
            $this->blogModel->toggleStatus($id);


        if ($result) {

            Flash::success(
                'Blog status updated successfully.'
            );

        } else {

            Flash::error(
                'Unable to update blog status.'
            );
        }


        $this->redirect(
            BASE_URL . '/admin/blogs'
        );
    }


    /**
     * ---------------------------------------------------------
     * Delete Blog
     * ---------------------------------------------------------
     */
    public function delete(): void
    {
        AdminAuthMiddleware::handle('blog.delete');


        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/blogs'
            );
        }


        /*
         * Decrypt blog ID
         */
        $id = Crypto::decryptId(
            $_POST['token'] ?? ''
        );


        if (!$id) {

            Flash::error(
                'Invalid blog.'
            );

            $this->redirect(
                BASE_URL . '/admin/blogs'
            );
        }


        /*
         * Soft delete
         */
        $result =
            $this->blogModel->delete($id);


        if ($result) {

            Flash::success(
                'Blog deleted successfully.'
            );

        } else {

            Flash::error(
                'Unable to delete blog.'
            );
        }


        $this->redirect(
            BASE_URL . '/admin/blogs'
        );
    }


    /**
     * ---------------------------------------------------------
     * Request Data
     * ---------------------------------------------------------
     */
    private function requestData(): array
    {
        return [

            'title' => trim(
                $_POST['title'] ?? ''
            ),

            /*
             * Summernote sends HTML.
             * Do NOT trim/strip HTML here.
             */
            'description' =>
                $_POST['description'] ?? '',

            'blog_date' =>
                trim($_POST['publish_date'] ?? ''),

            'is_active' =>
                isset($_POST['is_active'])
                    ? (int) $_POST['is_active']
                    : null,

            /*
             * Optional fields for future use.
             */
            'popular_tags' =>
                trim($_POST['popular_tags'] ?? ''),

            'author' =>
                trim($_POST['author'] ?? ''),

            /*
             * SEO fields can be added later.
             */
            'seo_title' =>
                trim($_POST['seo_title'] ?? ''),

            'seo_description' =>
                trim($_POST['seo_description'] ?? ''),

            'meta_tag' =>
                trim($_POST['meta_tag'] ?? ''),

            'meta_keyword' =>
                trim($_POST['meta_keyword'] ?? ''),

            'seo_canonical' =>
                trim($_POST['seo_canonical'] ?? ''),

            'seo_robots' =>
                trim($_POST['seo_robots'] ?? ''),

            'header_heading' =>
                trim($_POST['header_heading'] ?? ''),

            'header_sub_heading' =>
                trim($_POST['header_sub_heading'] ?? ''),

            'og_title' =>
                trim($_POST['og_title'] ?? ''),

            'og_description' =>
                trim($_POST['og_description'] ?? ''),

            'og_image' =>
                trim($_POST['og_image'] ?? ''),

            'faq_scripts' =>
                trim($_POST['faq_scripts'] ?? ''),

            'created_by' =>
                $_SESSION['user_id'] ?? null,

            'updated_by' =>
                $_SESSION['user_id'] ?? null
        ];
    }


    /**
     * ---------------------------------------------------------
     * Validate Blog Data
     * ---------------------------------------------------------
     */
    private function validateData(
        array $data
    ): ?string {

        /*
         * Title
         */
        if ($data['title'] === '') {

            return 'Title is required.';
        }


        if (
            mb_strlen($data['title']) < 2
        ) {

            return 'Title must be at least 2 characters.';
        }


        if (
            mb_strlen($data['title']) > 255
        ) {

            return 'Title must not exceed 255 characters.';
        }


        /*
         * Description
         *
         * Summernote sends HTML, therefore strip
         * HTML only for checking whether actual
         * text exists.
         */
        $descriptionText =
            trim(
                html_entity_decode(
                    strip_tags(
                        $data['description']
                    )
                )
            );


        if ($descriptionText === '') {

            return 'Description is required.';
        }


        /*
         * Publish date
         */
        if ($data['blog_date'] === '') {

            return 'Publish date is required.';
        }


        /*
         * Validate date format
         */
        $date = \DateTime::createFromFormat(
            'Y-m-d',
            $data['blog_date']
        );


        if (
            !$date ||
            $date->format('Y-m-d') !== $data['blog_date']
        ) {

            return 'Please enter a valid publish date.';
        }


        /*
         * Status
         *
         * Important:
         * 0 is valid because Inactive is allowed.
         */
        if (
            $data['is_active'] !== 0 &&
            $data['is_active'] !== 1
        ) {

            return 'Please select a valid status.';
        }


        return null;
    }


    /**
     * ---------------------------------------------------------
     * Upload Blog Image
     * ---------------------------------------------------------
     */
    private function uploadBlogImage(
        array $image,
        string $redirect
    ): string {

        /*
        * Upload error
        */
        if ($image['error'] !== UPLOAD_ERR_OK) {
            Flash::error('Unable to upload blog image.');
            $this->redirect($redirect);
        }

        /*
        * Maximum 2 MB
        */
        if ($image['size'] > 2 * 1024 * 1024) {
            Flash::error('Blog image must not exceed 2 MB.');
            $this->redirect($redirect);
        }

        /*
        * MIME type
        */
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

        /*
        * Validate actual image
        */
        $imageInfo = @getimagesize($image['tmp_name']);

        if (!$imageInfo) {
            Flash::error('Invalid blog image.');
            $this->redirect($redirect);
        }

        /*
        * Generate safe filename
        */
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

        $fileName =
            'blog_'
            . random_int(100000, 999999)
            . '_'
            . hrtime(true)
            . '.'
            . $extension;

        /*
        * Upload path
        * Same pattern as Team photos.
        */
        $directory = PUBLIC_PATH . '/blogs/';

        /*
        * Create directory if it doesn't exist.
        */
        if (!is_dir($directory)) {
            if (
                !mkdir(
                    $directory,
                    0755,
                    true
                ) &&
                !is_dir($directory)
            ) {
                Flash::error(
                    'Unable to create blog image directory.'
                );
                $this->redirect($redirect);
            }
        }

        /*
        * Full destination
        */
        $destination = $directory . $fileName;

        /*
        * Move uploaded file
        */
        if (!move_uploaded_file(
            $image['tmp_name'],
            $destination
        )) {
            Flash::error('Unable to save blog image.');
            $this->redirect($redirect);
        }

        /*
        * Store relative public path in database.
        */
        return 'blogs/' . $fileName;
    }
}

