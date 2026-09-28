<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">User Profile</h5>
        <a href="<?= $baseUrl ?>/admin/users/access?id=<?= (int) $user['id'] ?>" class="btn btn-primary">
            <i class="bi bi-shield-plus"></i>
            Manage Access
        </a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <strong>Name</strong>
                <div><?= htmlspecialchars($user['name'] ?? 'User') ?></div>
            </div>
            <div class="col-md-4 mb-3">
                <strong>Mobile</strong>
                <div><?= htmlspecialchars($user['mobile']) ?></div>
            </div>
            <div class="col-md-4 mb-3">
                <strong>Email</strong>
                <div><?= htmlspecialchars($user['email']) ?></div>
            </div>
            <div class="col-md-4 mb-3">
                <strong>User Type</strong>
                <div><?= htmlspecialchars($user['user_type_name'] ?? 'Not Set') ?></div>
            </div>
            <div class="col-md-4 mb-3">
                <strong>Status</strong>
                <div>
                    <span class="badge <?= $user['is_active'] ? 'bg-success' : 'bg-danger' ?>">
                        <?= $user['is_active'] ? 'Active' : 'Inactive' ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require VIEW_PATH . '/admin/users/_effective-access-table.php'; ?>

<?php require VIEW_PATH . '/admin/users/_access-history-table.php'; ?>
