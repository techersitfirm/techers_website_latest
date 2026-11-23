<div class="card">


<div class="card-header d-flex justify-content-between align-items-center">

    <h5 class="mb-0">
        Blog List
    </h5>

    <?php if (\app\core\Auth::can('blog.create')): ?>
        <a
            href="<?= $baseUrl ?>/admin/blogs/create"
            class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Add Blog

        </a>
    <?php endif; ?>

</div>

<div class="card-body p-0">

    <div class="table-responsive">

        <table
            id="blogTable"
            class="table table-striped table-hover mb-0 data-table">

            <thead>

                <tr>

                    <th>Title</th>

                    <th>Description</th>

                    <th>Image</th>

                    <th>Read Count</th>

                    <th>Status</th>

                    <th width="160">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (empty($blogs)): ?>

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-4">

                            No blog found.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach ($blogs as $blog): ?>

                        <tr>

                            <!-- Title -->
                            <td>
                                <?= htmlspecialchars($blog['title'] ?? '') ?>
                            </td>


                            <!-- Description - Maximum 25 Words -->
                            <td>

                                <?php
                                $description = trim(strip_tags($blog['description'] ?? ''));
                                $words = preg_split('/\s+/', $description);

                                if (count($words) > 25) {
                                    $description = implode(' ', array_slice($words, 0, 25)) . '...';
                                }
                                ?>

                                <?= htmlspecialchars($description) ?>

                            </td>


                            <!-- Image -->
                            <td>

                                <?php if (!empty($blog['intro_image'])): ?>

                                    <img
                                        src="<?= $baseUrl ?>/<?= htmlspecialchars($blog['intro_image']) ?>"
                                        alt="<?= htmlspecialchars($blog['title'] ?? 'Blog Image') ?>"
                                        width="60"
                                        height="60"
                                        class="rounded object-fit-cover">

                                <?php else: ?>

                                    <span class="text-muted">
                                        No Image
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- Read Count -->
                            <td>
                                <?= (int) ($blog['read_count'] ?? 0) ?>
                            </td>


                            <!-- Status -->
                            <td>

                                <?php if ($blog['is_active']): ?>

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

                                <?php if (\app\core\Auth::can('blog.remove')): ?>

                                    <form
                                        method="POST"
                                        action="<?= BASE_URL ?>/admin/blogs/toggle-status"
                                        class="d-inline">

                                        <?= \app\helpers\Csrf::field() ?>

                                        <input
                                            type="hidden"
                                            name="token"
                                            value="<?= htmlspecialchars($blog['token']) ?>">

                                        <button
                                            type="submit"
                                            class="btn btn-sm p-0 border-0 bg-transparent"
                                            title="<?= $blog['is_active'] ? 'Active' : 'Inactive' ?>">

                                            <i class="bi <?= $blog['is_active']
                                                ? 'bi-check-circle-fill text-success'
                                                : 'bi-x-circle-fill text-secondary' ?>"
                                                style="font-size: 1.25rem;">
                                            </i>

                                        </button>

                                    </form>

                                <?php endif; ?>


                                <?php if (\app\core\Auth::can('blog.edit')): ?>

                                    <a
                                        href="<?= BASE_URL ?>/admin/blogs/edit?token=<?= htmlspecialchars($blog['token']) ?>"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                <?php endif; ?>


                                <?php if (\app\core\Auth::can('blog.delete')): ?>

                                    <form
                                        method="POST"
                                        action="<?= BASE_URL ?>/admin/blogs/delete"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this blog?');">

                                        <?= \app\helpers\Csrf::field() ?>

                                        <input
                                            type="hidden"
                                            name="token"
                                            value="<?= htmlspecialchars($blog['token']) ?>">

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
