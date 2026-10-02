<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Access History</h5>
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
                        <th>Removed At</th>
                        <th>Removed By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $record): ?>
                        <?php
                            $isExpired = $record['expires_at'] && strtotime($record['expires_at']) < time();
                            $isRemoved = !$record['is_active'] || !empty($record['removed_at']);
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($record['permission_name']) ?></td>
                            <td><?= htmlspecialchars($record['module']) ?></td>
                            <td>
                                <?php if ($record['access_type'] === 'revoked'): ?>
                                    <span class="badge bg-danger">Revoked Access</span>
                                <?php elseif ($record['access_type'] === 'default'): ?>
                                    <span class="badge bg-primary">Default Access</span>
                                <?php else: ?>
                                    <span class="badge bg-info text-dark">Add-On Access</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $record['activated_at'] ? date('d-M-Y', strtotime($record['activated_at'])) : '-' ?></td>
                            <td><?= $record['expires_at'] ? date('d-M-Y', strtotime($record['expires_at'])) : '-' ?></td>
                            <td>
                                <?php if ($isRemoved): ?>
                                    <span class="badge bg-secondary">Removed</span>
                                <?php elseif ($isExpired): ?>
                                    <span class="badge bg-warning text-dark">Expired</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Active</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($record['assigned_by_name'] ?? '-') ?></td>
                            <td><?= $record['removed_at'] ? date('d-M-Y', strtotime($record['removed_at'])) : '-' ?></td>
                            <td><?= htmlspecialchars($record['removed_by_name'] ?? '-') ?></td>
                            <td>
                                <?php if ($record['access_type'] === 'revoked' && !$isRemoved && !$isExpired): ?>
                                    <form method="post" action="<?= $baseUrl ?>/admin/users/access/remove" class="d-inline">
                                        <?= \app\helpers\Csrf::field() ?>
                                        <input type="hidden" name="user_token" value="<?= htmlspecialchars($token) ?>">
                                        <input type="hidden" name="record_id" value="<?= (int) $record['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary" title="Restore default access">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
