<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Flash;
use App\Helpers\Crypto;
use App\Helpers\Csrf;
use App\Middleware\AdminAuthMiddleware;
use App\Models\JobsModel;

class JobsController extends Controller
{
    private JobsModel $jobsModel;


    public function __construct()
    {
        $this->jobsModel = new JobsModel();
    }


    /**
     * ---------------------------------------------------------
     * Jobs List
     * ---------------------------------------------------------
     */
    public function index(): void
    {
        AdminAuthMiddleware::handle('job.view');

        $jobs = $this->jobsModel->getAll();

        /*
         * Generate encrypted token for each job.
         */
        foreach ($jobs as &$job) {

            $job['token'] = Crypto::encryptId(
                (int) $job['id']
            );
        }

        unset($job);


        $this->renderAdmin('jobs/index', [
            'pageTitle' => 'Jobs Management',
            'jobs'      => $jobs
        ]);
    }


    /**
     * ---------------------------------------------------------
     * Create Job
     * ---------------------------------------------------------
     */
    public function create(): void
    {
        AdminAuthMiddleware::handle('job.create');

        $this->renderAdmin('jobs/create', [
            'pageTitle' => 'Add Job'
        ]);
    }


    /**
     * ---------------------------------------------------------
     * Store Job
     * ---------------------------------------------------------
     */
    public function store(): void
    {
        AdminAuthMiddleware::handle('job.create');


        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/jobs/create'
            );
        }


        $redirect = BASE_URL . '/admin/jobs/create';


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
         * Job image required
         */
        if (
            !isset($_FILES['image']) ||
            $_FILES['image']['error'] !== UPLOAD_ERR_OK
        ) {

            Flash::error(
                'Job image is required.'
            );

            $this->redirect($redirect);
        }


        /*
         * Upload image
         */
        $data['image'] =
            $this->uploadJobImage(
                $_FILES['image'],
                $redirect
            );


        /*
         * Create job
         */
        $jobId = $this->jobsModel->create($data);


        if (!$jobId) {

            Flash::error(
                'Unable to create job.'
            );

            $this->redirect($redirect);
        }


        Flash::success(
            'Job added successfully.'
        );


        $this->redirect(
            BASE_URL . '/admin/jobs'
        );
    }


    /**
     * ---------------------------------------------------------
     * Edit Job
     * ---------------------------------------------------------
     */
    public function edit(): void
    {
        AdminAuthMiddleware::handle('job.edit');


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
         * Find job
         */
        $job = $this->jobsModel->findById($id);


        if (!$job) {

            http_response_code(404);

            require VIEW_PATH . '/errors/404.php';

            exit;
        }


        /*
         * Generate token again for form.
         */
        $job['token'] = Crypto::encryptId(
            (int) $job['id']
        );


        $this->renderAdmin('jobs/edit', [
            'pageTitle' => 'Edit Job',
            'job'       => $job
        ]);
    }


    /**
     * ---------------------------------------------------------
     * Update Job
     * ---------------------------------------------------------
     */
    public function update(): void
    {
        AdminAuthMiddleware::handle('job.edit');


        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/jobs'
            );
        }


        /*
         * Decrypt token
         */
        $token = $_POST['token'] ?? '';

        $id = Crypto::decryptId($token);


        if (!$id) {

            Flash::error(
                'Invalid job.'
            );

            $this->redirect(
                BASE_URL . '/admin/jobs'
            );
        }


        /*
         * Existing job
         */
        $job = $this->jobsModel->findById($id);


        if (!$job) {

            Flash::error(
                'Job not found.'
            );

            $this->redirect(
                BASE_URL . '/admin/jobs'
            );
        }


        /*
         * Redirect back to edit page
         */
        $redirect =
            BASE_URL .
            '/admin/jobs/edit?token=' .
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
        $data['image'] =
            $job['image'] ?? null;


        /*
         * New image uploaded?
         */
        if (
            isset($_FILES['image']) &&
            $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $data['image'] =
                $this->uploadJobImage(
                    $_FILES['image'],
                    $redirect
                );
        }


        /*
         * Update
         */
        if (
            !$this->jobsModel->update(
                $id,
                $data
            )
        ) {

            Flash::error(
                'Unable to update job.'
            );

            $this->redirect($redirect);
        }


        Flash::success(
            'Job updated successfully.'
        );


        $this->redirect(
            BASE_URL . '/admin/jobs'
        );
    }


    /**
     * ---------------------------------------------------------
     * Toggle Job Status
     * ---------------------------------------------------------
     */
    public function toggleStatus(): void
    {
        AdminAuthMiddleware::handle('job.remove');


        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/jobs'
            );
        }


        /*
         * Decrypt job ID
         */
        $id = Crypto::decryptId(
            $_POST['token'] ?? ''
        );


        if (!$id) {

            Flash::error(
                'Invalid job.'
            );

            $this->redirect(
                BASE_URL . '/admin/jobs'
            );
        }


        /*
         * Toggle
         */
        $result =
            $this->jobsModel->toggleStatus($id);


        if ($result) {

            Flash::success(
                'Job status updated successfully.'
            );

        } else {

            Flash::error(
                'Unable to update job status.'
            );
        }


        $this->redirect(
            BASE_URL . '/admin/jobs'
        );
    }


    /**
     * ---------------------------------------------------------
     * Delete Job
     * ---------------------------------------------------------
     */
    public function delete(): void
    {
        AdminAuthMiddleware::handle('job.delete');


        /*
         * CSRF
         */
        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {

            Flash::error(
                'Invalid token. Please try again.'
            );

            $this->redirect(
                BASE_URL . '/admin/jobs'
            );
        }


        /*
         * Decrypt job ID
         */
        $id = Crypto::decryptId(
            $_POST['token'] ?? ''
        );


        if (!$id) {

            Flash::error(
                'Invalid job.'
            );

            $this->redirect(
                BASE_URL . '/admin/jobs'
            );
        }


        /*
         * Delete
         */
        $result =
            $this->jobsModel->delete($id);


        if ($result) {

            Flash::success(
                'Job deleted successfully.'
            );

        } else {

            Flash::error(
                'Unable to delete job.'
            );
        }


        $this->redirect(
            BASE_URL . '/admin/jobs'
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

            'title' =>
                trim(
                    $_POST['title'] ?? ''
                ),

            'job_location' =>
                trim(
                    $_POST['job_location'] ?? ''
                ),

            'qualification' =>
                trim(
                    $_POST['qualification'] ?? ''
                ),

            /*
             * Job brief may contain HTML.
             */
            'job_brief' =>
                $_POST['job_brief'] ?? '',

            'roll_skill' =>
                trim(
                    $_POST['roll_skill'] ?? ''
                ),

            'job_date' =>
                trim(
                    $_POST['job_date'] ?? ''
                ),

            'perks_benefits' =>
                trim(
                    $_POST['perks_benefits'] ?? ''
                ),

            'requirements' =>
                trim(
                    $_POST['requirements'] ?? ''
                ),

            'status' =>
                isset($_POST['status'])
                    ? (int) $_POST['status']
                    : null
        ];
    }


    /**
     * ---------------------------------------------------------
     * Validate Job Data
     * ---------------------------------------------------------
     */
    private function validateData(
        array $data
    ): ?string {

        /*
         * Title
         */
        if ($data['title'] === '') {

            return 'Job title is required.';
        }


        if (
            mb_strlen($data['title']) < 2
        ) {

            return 'Job title must be at least 2 characters.';
        }


        if (
            mb_strlen($data['title']) > 255
        ) {

            return 'Job title must not exceed 255 characters.';
        }


        /*
         * Job location
         */
        if (
            $data['job_location'] === ''
        ) {

            return 'Job location is required.';
        }


        /*
         * Qualification
         */
        if (
            $data['qualification'] === ''
        ) {

            return 'Qualification is required.';
        }


        /*
         * Job brief
         */
        $jobBriefText =
            trim(
                html_entity_decode(
                    strip_tags(
                        $data['job_brief']
                    )
                )
            );


        if ($jobBriefText === '') {

            return 'Job brief is required.';
        }


        /*
         * Role / Skill
         */
        if (
            $data['roll_skill'] === ''
        ) {

            return 'Role and skill is required.';
        }


        /*
         * Job date
         */
        if (
            $data['job_date'] === ''
        ) {

            return 'Job date is required.';
        }


        /*
         * Validate date
         */
        $date = \DateTime::createFromFormat(
            'Y-m-d',
            $data['job_date']
        );


        if (
            !$date ||
            $date->format('Y-m-d') !== $data['job_date']
        ) {

            return 'Please enter a valid job date.';
        }


        /*
         * Perks & Benefits
         */
        if (
            $data['perks_benefits'] === ''
        ) {

            return 'Perks & benefits are required.';
        }


        /*
         * Requirements
         */
        if (
            $data['requirements'] === ''
        ) {

            return 'Requirements are required.';
        }


        /*
         * Status
         */
        if (
            $data['status'] !== 0 &&
            $data['status'] !== 1
        ) {

            return 'Please select a valid status.';
        }


        return null;
    }


    /**
     * ---------------------------------------------------------
     * Upload Job Image
     * ---------------------------------------------------------
     */
    private function uploadJobImage(
        array $image,
        string $redirect
    ): string {

        /*
         * Upload error
         */
        if (
            $image['error'] !== UPLOAD_ERR_OK
        ) {

            Flash::error(
                'Unable to upload job image.'
            );

            $this->redirect($redirect);
        }


        /*
         * Maximum 2 MB
         */
        if (
            $image['size'] > 2 * 1024 * 1024
        ) {

            Flash::error(
                'Job image must not exceed 2 MB.'
            );

            $this->redirect($redirect);
        }


        /*
         * MIME type
         */
        $mime =
            (new \finfo(FILEINFO_MIME_TYPE))
                ->file($image['tmp_name']);


        $allowedMimes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        if (
            !in_array(
                $mime,
                $allowedMimes,
                true
            )
        ) {

            Flash::error(
                'Only JPG, PNG and WebP images are allowed.'
            );

            $this->redirect($redirect);
        }


        /*
         * Validate actual image.
         */
        $imageInfo =
            @getimagesize(
                $image['tmp_name']
            );


        if (!$imageInfo) {

            Flash::error(
                'Invalid job image.'
            );

            $this->redirect($redirect);
        }


        /*
         * Generate safe filename.
         */
        $extension = match ($mime) {

            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',

            default => null
        };


        if (!$extension) {

            Flash::error(
                'Invalid image format.'
            );

            $this->redirect($redirect);
        }


        $fileName =
            'job_'
            . random_int(100000, 999999)
            . '_'
            . hrtime(true)
            . '.'
            . $extension;


        /*
         * Public upload path.
         *
         * Same pattern as Team and Blog.
         */
        $directory =
            PUBLIC_PATH . '/jobs/';


        /*
         * Create directory if required.
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
                    'Unable to create job image directory.'
                );

                $this->redirect($redirect);
            }
        }


        /*
         * Full destination.
         */
        $destination =
            $directory .
            $fileName;


        /*
         * Move uploaded file.
         */
        if (
            !move_uploaded_file(
                $image['tmp_name'],
                $destination
            )
        ) {

            Flash::error(
                'Unable to save job image.'
            );

            $this->redirect($redirect);
        }


        /*
         * Store relative public path in database.
         *
         * Example:
         * jobs/job_123456_123456789.jpg
         */
        return 'jobs/' . $fileName;
    }
}