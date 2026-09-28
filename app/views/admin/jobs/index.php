<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Jobs List
        </h5>

        <?php if (\App\Core\Auth::can('job.create')): ?>
            <a
                href="<?= $baseUrl ?>/admin/jobs/create"
                class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Add Job
            </a>
        <?php endif; ?>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table
                id="jobTable"
                class="table table-striped table-hover mb-0 data-table">

                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Qualification</th>
                        <th>Brief</th>
                        <th>Image</th>
                        <th>Job Date</th>
                        <th>Status</th>
                        <th width="160">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (empty($jobs)): ?>

                        <tr>
                            <td
                                colspan="8"
                                class="text-center py-4">
                                No job found.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($jobs as $job): ?>

                            <tr>

                                <!-- Title -->
                                <td>
                                    <?= htmlspecialchars($job['title'] ?? '') ?>
                                </td>

                                <!-- Location -->
                                <td>
                                    <?= htmlspecialchars($job['job_location'] ?? '') ?>
                                </td>

                                <!-- Qualification -->
                                <td>
                                    <?= htmlspecialchars($job['qualification'] ?? '') ?>
                                </td>

                                <!-- Brief - Maximum 25 Words -->
                                <td>
                                    <?php
                                    $brief = trim(
                                        strip_tags($job['job_brief'] ?? '')
                                    );

                                    $words = preg_split('/\s+/', $brief);

                                    if (count($words) > 25) {
                                        $brief = implode(
                                            ' ',
                                            array_slice($words, 0, 25)
                                        ) . '...';
                                    }
                                    ?>

                                    <?= htmlspecialchars($brief) ?>
                                </td>

                                <!-- Image -->
                                <td>

                                    <?php if (!empty($job['image'])): ?>

                                        <img
                                            src="<?= $baseUrl ?>/<?= htmlspecialchars($job['image']) ?>"
                                            alt="<?= htmlspecialchars($job['title'] ?? 'Job Image') ?>"
                                            width="60"
                                            height="60"
                                            class="rounded object-fit-cover">

                                    <?php else: ?>

                                        <span class="text-muted">
                                            No Image
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- Job Date -->
                                <td>
                                    <?= !empty($job['job_date'])
                                        ? htmlspecialchars(
                                            date(
                                                'd-m-Y',
                                                strtotime($job['job_date'])
                                            )
                                        )
                                        : '-'
                                    ?>
                                </td>

                                <!-- Status -->
                                <td>

                                    <?php if ((int) ($job['status'] ?? 0) === 1): ?>

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

                                    <?php if (\App\Core\Auth::can('job.remove')): ?>

                                        <form
                                            method="POST"
                                            action="<?= BASE_URL ?>/admin/jobs/toggle-status"
                                            class="d-inline">

                                            <?= \App\Helpers\Csrf::field() ?>

                                            <input
                                                type="hidden"
                                                name="token"
                                                value="<?= htmlspecialchars($job['token'] ?? '') ?>">

                                            <button
                                                type="submit"
                                                class="btn btn-sm p-0 border-0 bg-transparent"
                                                title="<?= ((int) ($job['status'] ?? 0) === 1) ? 'Active' : 'Inactive' ?>">

                                                <i
                                                    class="bi <?= ((int) ($job['status'] ?? 0) === 1)
                                                        ? 'bi-check-circle-fill text-success'
                                                        : 'bi-x-circle-fill text-secondary' ?>"
                                                    style="font-size: 1.25rem;">
                                                </i>

                                            </button>

                                        </form>

                                    <?php endif; ?>


                                    <?php if (\App\Core\Auth::can('job.edit')): ?>

                                        <a
                                            href="<?= BASE_URL ?>/admin/jobs/edit?token=<?= htmlspecialchars($job['token'] ?? '') ?>"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Edit">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    <?php endif; ?>


                                    <?php if (\App\Core\Auth::can('job.delete')): ?>

                                        <form
                                            method="POST"
                                            action="<?= BASE_URL ?>/admin/jobs/delete"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this job?');">

                                            <?= \App\Helpers\Csrf::field() ?>

                                            <input
                                                type="hidden"
                                                name="token"
                                                value="<?= htmlspecialchars($job['token'] ?? '') ?>">

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