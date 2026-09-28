<form method="post" action="<?= $baseUrl ?>/admin/user-types/permissions/update">
    <input type="hidden" name="id" value="<?= (int) $userType['id'] ?>">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <?= htmlspecialchars($userType['name']) ?>
                <span class="text-muted fw-normal">Default Access</span>
            </h5>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i>
                Save Access
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 data-table">
                    <thead>
                        <tr>
                            <th>Permission</th>
                            <th>Module</th>
                            <th>Slug</th>
                            <th>Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($permissions as $permission): ?>
                            <tr>
                                <td><?= htmlspecialchars($permission['name']) ?></td>
                                <td><?= htmlspecialchars($permission['module']) ?></td>
                                <td><?= htmlspecialchars($permission['slug']) ?></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="permissions[]"
                                            value="<?= (int) $permission['id'] ?>"
                                            id="permission_<?= (int) $permission['id'] ?>"
                                            <?= in_array((int) $permission['id'], $selectedPermissionIds, true) ? 'checked' : '' ?>>
                                        <label
                                            class="form-check-label"
                                            for="permission_<?= (int) $permission['id'] ?>">
                                            Default Access
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <a href="<?= $baseUrl ?>/admin/user-types" class="btn btn-secondary">Back</a>
        </div>
    </div>
</form>
