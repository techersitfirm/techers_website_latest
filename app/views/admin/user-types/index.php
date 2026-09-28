<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">User Type List</h5>
        <a href="<?= $baseUrl ?>/admin/user-types/create" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Add User Type
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="170">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userTypes as $userType): ?>
                        <tr>
                            <td><?= htmlspecialchars($userType['name']) ?></td>
                            <td><?= htmlspecialchars($userType['description'] ?? '-') ?></td>
                            <td>
                                <span class="badge <?= $userType['is_active'] ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $userType['is_active'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <a
                                    href="<?= $baseUrl ?>/admin/user-types/edit?id=<?= (int) $userType['id'] ?>"
                                    class="btn btn-sm btn-outline-secondary"
                                    title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a
                                    href="<?= $baseUrl ?>/admin/user-types/permissions?id=<?= (int) $userType['id'] ?>"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Default Access">
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
