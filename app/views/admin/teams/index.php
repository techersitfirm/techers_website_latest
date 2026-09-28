<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Team List
        </h5>

        <?php if (\App\Core\Auth::can('team.create')): ?>
            <a
                href="<?= $baseUrl ?>/admin/teams/create"
                class="btn btn-primary">

                <i class="bi bi-plus-lg"></i>
                Add Team

            </a>
        <?php endif; ?>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

        <table id="teamTable" class="table table-striped table-hover mb-0 data-table">

            <thead>

                <tr>

                    <th>Name</th>

                    <th>Mobile</th>

                    <th>Email</th>

                    <th>User Type</th>

                    <th>Status</th>

                    <th width="160">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (empty($teams)): ?>

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-4">

                            No team found.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach ($teams as $team): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($team['name'] ?? 'User') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($team['mobile']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($team['email']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($team['user_type_name'] ?? 'Not Set') ?>
                            </td>

                            <td>

                                <?php if ($team['is_active']): ?>

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>
                            <?php if (\App\Core\Auth::can('team.remove')): ?>
                                <form
                                    method="POST"
                                    action="<?= BASE_URL ?>/admin/teams/toggle-status"
                                    class="d-inline">

                                    <?= \App\Helpers\Csrf::field() ?>

                                    <input
                                        type="hidden"
                                        name="token"
                                        value="<?= htmlspecialchars($team['token']) ?>">

                                    <button
                                        type="submit"
                                        class="btn btn-sm p-0 border-0 bg-transparent"
                                        title="<?= $team['is_active'] ? 'Active' : 'Inactive' ?>">

                                        <i class="bi <?= $team['is_active']
                                            ? 'bi-check-circle-fill text-success'
                                            : 'bi-x-circle-fill text-secondary' ?>"
                                            style="font-size: 1.25rem;">
                                        </i>

                                    </button>

                                </form>
                            <?php endif; ?>

                            <?php if (\App\Core\Auth::can('team.edit')): ?>
                                <a
                                    href="<?= BASE_URL ?>/admin/teams/edit?token=<?= htmlspecialchars($team['token']) ?>"
                                    class="btn btn-sm btn-outline-secondary"
                                    title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (\App\Core\Auth::can('user.view')): ?>
                                <a
                                    href="<?= BASE_URL ?>/admin/users/profile?id=<?= (int) $team['id'] ?>"
                                    class="btn btn-sm btn-outline-secondary"
                                    title="Profile">
                                    <i class="bi bi-person-lines-fill"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (\App\Core\Auth::can('permission.assign')): ?>
                                <a
                                    href="<?= BASE_URL ?>/admin/users/access?id=<?= (int) $team['id'] ?>"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Access">
                                    <i class="bi bi-shield-check"></i>
                                </a>
                            <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>

        </div>

    </div>

</div>
