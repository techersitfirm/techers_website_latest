<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Project List
        </h5>

        <?php if (\App\Core\Auth::can('project.create')): ?>

            <a
                href="<?= $baseUrl ?>/admin/projects/create"
                class="btn btn-primary">

                <i class="bi bi-plus-lg"></i>
                Add Project

            </a>

        <?php endif; ?>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table
                id="projectTable"
                class="table table-striped table-hover mb-0 data-table">

                <thead>

                    <tr>
                        <th>Name</th>
                        <th>Project Type</th>
                        <th>Image</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th width="160">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($projects)): ?>

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-4">

                                No project found.

                            </td>

                        </tr>

                    <?php else: ?>

                        <?php foreach ($projects as $project): ?>

                            <tr>

                                <!-- Name -->
                                <td>
                                    <?= htmlspecialchars(
                                        $project['name'] ?? ''
                                    ) ?>
                                </td>

                                <!-- Project Type -->
                                <td>
                                    <?= htmlspecialchars(
                                        $project['project_type'] ?? ''
                                    ) ?>
                                </td>

                                <!-- Image -->
                                <td>

                                    <?php if (!empty($project['ProfilePic'])): ?>

                                        <img
                                            src="<?= $baseUrl ?>/<?= htmlspecialchars($project['ProfilePic']) ?>"
                                            alt="<?= htmlspecialchars($project['name'] ?? 'Project Image') ?>"
                                            width="60"
                                            height="60"
                                            class="rounded object-fit-cover">

                                    <?php else: ?>

                                        <span class="text-muted">
                                            No Image
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- Link -->
                                <td>

                                    <?php if (!empty($project['link'])): ?>

                                        <a
                                            href="<?= htmlspecialchars($project['link']) ?>"
                                            target="_blank"
                                            rel="noopener noreferrer">

                                            View Project

                                        </a>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            -
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- Status -->
                                <td>

                                    <?php if ((int) ($project['status'] ?? 0) === 1): ?>

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- Action -->
                                <td>

                                    <?php if (\App\Core\Auth::can('project.remove')): ?>

                                        <form
                                            method="POST"
                                            action="<?= BASE_URL ?>/admin/projects/toggle-status"
                                            class="d-inline">

                                            <?= \App\Helpers\Csrf::field() ?>

                                            <input
                                                type="hidden"
                                                name="token"
                                                value="<?= htmlspecialchars($project['token']) ?>">

                                            <button
                                                type="submit"
                                                class="btn btn-sm p-0 border-0 bg-transparent"
                                                title="<?= ((int) $project['status'] === 1) ? 'Active' : 'Inactive' ?>">

                                                <i
                                                    class="bi <?= ((int) $project['status'] === 1)
                                                        ? 'bi-check-circle-fill text-success'
                                                        : 'bi-x-circle-fill text-secondary' ?>"
                                                    style="font-size: 1.25rem;">
                                                </i>

                                            </button>

                                        </form>

                                    <?php endif; ?>


                                    <?php if (\App\Core\Auth::can('project.edit')): ?>

                                        <a
                                            href="<?= BASE_URL ?>/admin/projects/edit?token=<?= htmlspecialchars($project['token']) ?>"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Edit">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    <?php endif; ?>


                                    <?php if (\App\Core\Auth::can('project.delete')): ?>

                                        <form
                                            method="POST"
                                            action="<?= BASE_URL ?>/admin/projects/delete"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this project?');">

                                            <?= \App\Helpers\Csrf::field() ?>

                                            <input
                                                type="hidden"
                                                name="token"
                                                value="<?= htmlspecialchars($project['token']) ?>">

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

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