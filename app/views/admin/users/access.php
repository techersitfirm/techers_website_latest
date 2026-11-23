<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <?= htmlspecialchars($user['name'] ?? 'User') ?>
            <span class="text-muted fw-normal">
                (<?= htmlspecialchars($user['user_type_name'] ?? 'No User Type') ?>)
            </span>
        </h5>
    </div>

    <div class="card-body">
        <form method="post" action="<?= $baseUrl ?>/admin/users/access/add">
            <?= \app\helpers\Csrf::field() ?>
            <input type="hidden" name="user_token" value="<?= htmlspecialchars($token) ?>">

            <div class="row align-items-end">
                <div class="col-lg-4 col-md-6 mb-3">
                    <label class="form-label">Add-On Permission</label>
                    <select name="permission_id" class="form-select" required>
                        <option value="">Select Permission</option>
                        <?php
                            $effectivePermissionIds = array_map(
                                static fn (array $permission): int => (int) $permission['id'],
                                $effectivePermissions
                            );
                        ?>
                        <?php foreach ($permissions as $permission): ?>
                            <?php $alreadyAssigned = in_array((int) $permission['id'], $effectivePermissionIds, true); ?>
                            <option
                                value="<?= (int) $permission['id'] ?>"
                                <?= $alreadyAssigned ? 'disabled' : '' ?>>
                                <?= htmlspecialchars($permission['module'] . ' - ' . $permission['name']) ?>
                                <?= $alreadyAssigned ? ' (Already assigned)' : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <label class="form-label">Activated At</label>
                    <input
                        type="date"
                        name="activated_at"
                        class="form-control"
                        value="<?= date('Y-m-d') ?>"
                        required>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="expires_at" class="form-control">
                </div>

                <div class="col-lg-2 col-md-6 mb-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-plus-lg"></i>
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require VIEW_PATH . '/admin/users/_effective-access-table.php'; ?>

<?php require VIEW_PATH . '/admin/users/_access-history-table.php'; ?>
