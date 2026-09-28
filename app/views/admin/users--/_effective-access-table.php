<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Effective Access</h5>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 data-table">
                <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Module</th>
                        <th>Access Type</th>
                        <th>Activated At</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Assigned By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($effectivePermissions as $permission): ?>
                        <tr>
                            <td><?= htmlspecialchars($permission['name']) ?></td>
                            <td><?= htmlspecialchars($permission['module']) ?></td>
                            <td>
                                <?php if ($permission['access_type'] === 'default'): ?>
                                    <span class="badge bg-primary">Default Access</span>
                                <?php elseif ($permission['access_type'] === 'included'): ?>
                                    <span class="badge bg-secondary">Included Access</span>
                                <?php else: ?>
                                    <span class="badge bg-info text-dark">Add-On Access</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $permission['activated_at'] ? date('d-M-Y', strtotime($permission['activated_at'])) : '-' ?></td>
                            <td><?= $permission['expires_at'] ? date('d-M-Y', strtotime($permission['expires_at'])) : '-' ?></td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td><?= htmlspecialchars($permission['assigned_by_name'] ?? '-') ?></td>
                            <td>
                                <?php if ($permission['access_type'] === 'addon'): ?>
                                    <form method="post" action="<?= $baseUrl ?>/admin/users/access/remove" class="d-inline">
                                        <?= \App\Helpers\Csrf::field() ?>
                                        <input type="hidden" name="user_token" value="<?= htmlspecialchars($token) ?>">
                                        <input type="hidden" name="record_id" value="<?= (int) $permission['record_id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>

                                    <form method="post" action="<?= $baseUrl ?>/admin/users/access/extend" class="d-inline-flex gap-1 mt-1">
                                        <?= \App\Helpers\Csrf::field() ?>
                                        <input type="hidden" name="user_token" value="<?= htmlspecialchars($token) ?>">
                                        <input type="hidden" name="record_id" value="<?= (int) $permission['record_id'] ?>">
                                        <input type="date" name="expires_at" class="form-control form-control-sm">
                                        <button type="submit" class="btn btn-sm btn-outline-primary" title="Extend">
                                            <i class="bi bi-calendar-plus"></i>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form method="post" action="<?= $baseUrl ?>/admin/users/access/revoke" class="d-inline">
                                        <?= \App\Helpers\Csrf::field() ?>
                                        <input type="hidden" name="user_token" value="<?= htmlspecialchars($token) ?>">
                                        <input type="hidden" name="permission_id" value="<?= (int) $permission['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Revoke access for this user">
                                            <i class="bi bi-slash-circle"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
