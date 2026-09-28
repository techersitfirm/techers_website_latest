<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Permission List</h5>
        <a href="<?= $baseUrl ?>/admin/permissions/create" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Add Permission
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 data-table">
                <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Module</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($permissions as $permission): ?>
                        <tr>
                            <td><?= htmlspecialchars($permission['name']) ?></td>
                            <td><?= htmlspecialchars($permission['module']) ?></td>
                            <td><?= htmlspecialchars($permission['slug']) ?></td>
                            <td><?= htmlspecialchars($permission['description'] ?? '-') ?></td>
                            <td>
                                <span class="badge <?= $permission['is_active'] ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $permission['is_active'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <form method="post" action="<?= $baseUrl ?>/admin/permissions/toggle-status" class="d-inline">
                                    <input type="hidden" name="id" value="<?= (int) $permission['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Toggle Status">
                                        <i class="bi <?= $permission['is_active'] ? 'bi-toggle-on' : 'bi-toggle-off' ?>"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
