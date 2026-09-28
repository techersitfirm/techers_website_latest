<?php
$baseUrl = BASE_URL;
?>

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">Testimonials</h5>

        <?php if (\App\Core\Auth::can('testimonial.create')): ?>

            <a
                href="<?= $baseUrl ?>/admin/testimonials/create"
                class="btn btn-primary btn-sm">

                <i class="bi bi-plus-lg"></i>
                Add Testimonial

            </a>

        <?php endif; ?>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-striped table-hover mb-0 data-table">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th width="140">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($testimonials)): ?>

                        <?php foreach ($testimonials as $testimonial): ?>

                            <tr>

                                <td>
                                    <?= (int) $testimonial['ID'] ?>
                                </td>

                                <td>

                                    <?php if (!empty($testimonial['ProfilePic'])): ?>

                                        <img
                                            src="<?= $baseUrl ?>/<?= htmlspecialchars($testimonial['ProfilePic']) ?>"
                                            alt="<?= htmlspecialchars($testimonial['name']) ?>"
                                            style="width:60px;height:60px;object-fit:cover;border-radius:6px;">

                                    <?php else: ?>

                                        <span class="text-muted">
                                            No Image
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>
                                    <?= htmlspecialchars($testimonial['name']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($testimonial['type']) ?>
                                </td>

                                <td style="min-width:300px; max-width:450px;">

                                    <?php
                                    $content = trim($testimonial['content']);
                                    ?>

                                    <?= htmlspecialchars(
                                        mb_strimwidth(
                                            $content,
                                            0,
                                            150,
                                            '...'
                                        )
                                    ) ?>

                                </td>

                                <td>

                                    <?php if ((int) $testimonial['status'] === 1): ?>

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

                                    <?php if (\App\Core\Auth::can('testimonial.edit')): ?>

                                        <a
                                            href="<?= $baseUrl ?>/admin/testimonials/edit?token=<?= urlencode($testimonial['token']) ?>"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Edit">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                    <?php endif; ?>


                                    <?php if (\App\Core\Auth::can('testimonial.remove')): ?>

                                        <form
                                            method="POST"
                                            action="<?= $baseUrl ?>/admin/testimonials/toggle-status"
                                            class="d-inline">

                                            <?= \App\Helpers\Csrf::field() ?>

                                            <input
                                                type="hidden"
                                                name="token"
                                                value="<?= htmlspecialchars($testimonial['token']) ?>">

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Toggle Status">

                                                <?php if ((int) $testimonial['status'] === 1): ?>

                                                    <i class="bi bi-toggle-on"></i>

                                                <?php else: ?>

                                                    <i class="bi bi-toggle-off"></i>

                                                <?php endif; ?>

                                            </button>

                                        </form>

                                    <?php endif; ?>


                                    <?php if (\App\Core\Auth::can('testimonial.delete')): ?>

                                        <form
                                            method="POST"
                                            action="<?= $baseUrl ?>/admin/testimonials/delete"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this testimonial?');">

                                            <?= \App\Helpers\Csrf::field() ?>

                                            <input
                                                type="hidden"
                                                name="token"
                                                value="<?= htmlspecialchars($testimonial['token']) ?>">

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

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-4">

                                No testimonials found.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>