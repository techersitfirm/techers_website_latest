<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">User List</h5>
        <a href="<?= $baseUrl ?>/admin/teams/create" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Add User
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th width="160">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['name'] ?? 'User') ?></td>
                            <td><?= htmlspecialchars($user['mobile']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['user_type_name'] ?? 'Not Set') ?></td>
                            <td>
                                <span class="badge <?= $user['is_active'] ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $user['is_active'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <a
                                    href="<?= $baseUrl ?>/admin/teams/edit?token=<?= htmlspecialchars(\app\helpers\Crypto::encrypt((string) $user['id'])) ?>"
                                    class="btn btn-sm btn-outline-secondary"
                                    title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a
                                    href="<?= $baseUrl ?>/admin/users/profile?id=<?= (int) $user['id'] ?>"
                                    class="btn btn-sm btn-outline-secondary"
                                    title="Profile">
                                    <i class="bi bi-person-lines-fill"></i>
                                </a>
                                <a
                                    href="<?= $baseUrl ?>/admin/users/access?id=<?= (int) $user['id'] ?>"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Access">
                                    <i class="bi bi-shield-check"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
