<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Flash;
use App\Helpers\Crypto;
use App\Helpers\Csrf;
use App\Helpers\FileUpload;
use App\Helpers\Validator;
use App\Middleware\AdminAuthMiddleware;
use App\Models\UserModel;
use App\Models\UserTypeModel;

class TeamController extends Controller
{
    private UserModel $userModel;
    private UserTypeModel $userTypeModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userTypeModel = new UserTypeModel();
    }

    public function index(): void
    {
        AdminAuthMiddleware::handle('team.view');

        $teams = $this->userModel->getAll();

        foreach ($teams as &$team) {
            $team['token'] = Crypto::encryptId((int) $team['id']);
        }

        $this->renderAdmin('teams/index', [
            'pageTitle' => 'Team Management',
            'teams' => $teams
        ]);
    }

    public function create(): void
    {
        AdminAuthMiddleware::handle('team.create');

        $this->renderAdmin('teams/create', [
            'pageTitle' => 'Add User',
            'posts' => $this->userModel->getActivePosts(),
            'states' => $this->userModel->getActiveStates(),
            'userTypes' => $this->userTypeModel->getActive()
        ]);
    }

    public function store(): void
    {
        AdminAuthMiddleware::handle('team.create');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid token. Please try again.');
            $this->redirect(BASE_URL . '/admin/teams/create');
        }

        $redirect = BASE_URL . '/admin/teams/create';
        $data = $this->requestData(true);
        $validation = $this->validateData($data, true, null);

        if ($validation !== null) {
            Flash::error($validation);
            $this->redirect($redirect);
        }

        if (!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
            Flash::error('Profile picture is required.');
            $this->redirect($redirect);
        }

        $profilePic = $this->uploadProfile($_FILES['profile_pic'], $redirect);
        $data['profile_pic'] = $profilePic;

        $userId = $this->userModel->create($data);

        if (!$userId) {
            Flash::error('Unable to create user.');
            $this->redirect($redirect);
        }

        Flash::success('User added successfully.');
        $this->redirect(BASE_URL . '/admin/teams');
    }

    public function edit(): void
    {
        AdminAuthMiddleware::handle('team.edit');

        $id = Crypto::decryptId($_GET['token'] ?? '');

        if (!$id) {
            http_response_code(404);
            require VIEW_PATH . '/errors/404.php';
            exit;
        }

        $team = $this->userModel->findById($id);

        if (!$team) {
            http_response_code(404);
            require VIEW_PATH . '/errors/404.php';
            exit;
        }

        $this->renderAdmin('teams/edit', [
            'pageTitle' => 'Edit User',
            'team' => $team,
            'posts' => $this->userModel->getActivePosts(),
            'states' => $this->userModel->getActiveStates(),
            'userTypes' => $this->userTypeModel->getActive()
        ]);
    }

    public function update(): void
    {
        AdminAuthMiddleware::handle('team.edit');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid token. Please try again.');
            $this->redirect(BASE_URL . '/admin/teams');
        }

        $token = $_POST['token'] ?? '';
        $id = Crypto::decryptId($token);

        if (!$id) {
            Flash::error('Invalid user.');
            $this->redirect(BASE_URL . '/admin/teams');
        }

        $team = $this->userModel->findById($id);

        if (!$team) {
            Flash::error('User not found.');
            $this->redirect(BASE_URL . '/admin/teams');
        }

        $redirect = BASE_URL . '/admin/teams/edit?token=' . urlencode($token);
        $data = $this->requestData(false);
        $validation = $this->validateData($data, false, $id);

        if ($validation !== null) {
            Flash::error($validation);
            $this->redirect($redirect);
        }

        $data['profile_pic'] = $team['profile_pic'];

        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] !== UPLOAD_ERR_NO_FILE) {
            $data['profile_pic'] = $this->uploadProfile($_FILES['profile_pic'], $redirect);
        }

        if (!$this->userModel->update($id, $data)) {
            Flash::error('Unable to update user.');
            $this->redirect($redirect);
        }

        Flash::success('User updated successfully.');
        $this->redirect(BASE_URL . '/admin/teams');
    }

    public function toggleStatus(): void
    {
        AdminAuthMiddleware::handle('team.remove');

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            Flash::error('Invalid token. Please try again.');
            $this->redirect(BASE_URL . '/admin/teams');
        }

        $id = Crypto::decryptId($_POST['token'] ?? '');

        if (!$id) {
            Flash::error('Invalid user.');
            $this->redirect(BASE_URL . '/admin/teams');
        }

        $this->userModel->toggleStatus($id)
            ? Flash::success('User status updated successfully.')
            : Flash::error('Unable to update user status.');

        $this->redirect(BASE_URL . '/admin/teams');
    }

    private function requestData(bool $passwordRequired): array
    {
        return [
            'name' => trim($_POST['name'] ?? ''),
            'mobile' => trim($_POST['mobile'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => trim($_POST['password'] ?? ''),
            'user_type_id' => (int) ($_POST['user_type_id'] ?? 0),
            'post_id' => (int) ($_POST['post_id'] ?? 0),
            'show_on_website' => (int) ($_POST['show_on_website'] ?? 0),
            'address' => trim($_POST['address'] ?? ''),
            'city' => trim($_POST['city'] ?? ''),
            'state_id' => (int) ($_POST['state_id'] ?? 0),
            'country' => trim($_POST['country'] ?? ''),
            'instagram' => trim($_POST['instagram'] ?? ''),
            'facebook' => trim($_POST['facebook'] ?? ''),
            'linkedin' => trim($_POST['linkedin'] ?? ''),
            'created_by' => $_SESSION['user_id'] ?? null,
            'updated_by' => $_SESSION['user_id'] ?? null,
            '_password_required' => $passwordRequired
        ];
    }

    private function validateData(array $data, bool $passwordRequired, ?int $excludeId): ?string
    {
        $error = Validator::required($data, [
            'name',
            'mobile',
            'email',
            'user_type_id',
            'post_id',
            'show_on_website'
            // 'address',
            // 'city',
            // 'state_id',
            // 'country'
        ]);

        if ($error) {
            return $error;
        }

        if ($passwordRequired && $data['password'] === '') {
            return 'Password is required.';
        }

        if ($data['password'] !== '' && strlen($data['password']) < 8) {
            return 'Password must be at least 8 characters.';
        }

        if (!Validator::name($data['name'])) {
            return 'Please enter a valid name.';
        }

        if (!Validator::mobile($data['mobile'])) {
            return 'Please enter a valid 10-digit mobile number.';
        }

        if (!Validator::email($data['email'])) {
            return 'Please enter a valid email address.';
        }

        if($data['show_on_website'] === '') {
            return 'Show on website is required.';
        }

        $userType = $this->userTypeModel->findById((int) $data['user_type_id']);

        if (!$userType || (int) $userType['is_active'] !== 1) {
            return 'Please select a valid user type.';
        }

        if ($this->userModel->emailExists($data['email'], $excludeId)) {
            return 'Email already exists.';
        }

        if ($this->userModel->mobileExists($data['mobile'], $excludeId)) {
            return 'Mobile already exists.';
        }

        foreach (['instagram' => 'instagram.com', 'facebook' => 'facebook.com', 'linkedin' => 'linkedin.com'] as $field => $domain) {
            if (!Validator::socialUrl($data[$field], $domain)) {
                return 'Please enter a valid ' . ucfirst($field) . ' URL.';
            }
        }

        return null;
    }

    private function uploadProfile(array $photo, string $redirect): string
    {
        if ($photo['error'] !== UPLOAD_ERR_OK) {
            Flash::error('Unable to upload profile picture.');
            $this->redirect($redirect);
        }

        if ($photo['size'] > 2 * 1024 * 1024) {
            Flash::error('Profile picture must not exceed 2 MB.');
            $this->redirect($redirect);
        }

        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($photo['tmp_name']);

        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'], true)) {
            Flash::error('Only JPG, PNG and WebP images are allowed.');
            $this->redirect($redirect);
        }

        $image = getimagesize($photo['tmp_name']);

        if (!$image || $image[0] !== 791 || $image[1] !== 791) {
            Flash::error('Profile picture must be exactly 791 x 791 pixels.');
            $this->redirect($redirect);
        }

        try {
            return FileUpload::teamPhoto($photo);
        } catch (\Throwable $e) {
            Flash::error('Unable to upload profile picture.');
            $this->redirect($redirect);
        }
    }
}
