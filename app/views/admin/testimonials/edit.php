<?php
$baseUrl = BASE_URL;
?>

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">Edit Testimonial</h5>
    </div>

    <form
        method="POST"
        action="<?= $baseUrl ?>/admin/testimonials/update"
        enctype="multipart/form-data">

        <?= \app\helpers\Csrf::field() ?>

        <input
            type="hidden"
            name="token"
            value="<?= htmlspecialchars($testimonial['token']) ?>">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        maxlength="1200"
                        value="<?= htmlspecialchars($testimonial['name']) ?>"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Type <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="type"
                        class="form-control"
                        maxlength="1200"
                        value="<?= htmlspecialchars($testimonial['type']) ?>"
                        placeholder="e.g. Patient, Client, Google Review"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Testimonial Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Leave empty to keep the existing image.
                        JPG, JPEG, PNG or WEBP. Maximum 2 MB.
                    </small>

                    <?php if (!empty($testimonial['ProfilePic'])): ?>

                        <div class="mt-3">

                            <img
                                src="<?= $baseUrl ?>/<?= htmlspecialchars($testimonial['ProfilePic']) ?>"
                                alt="<?= htmlspecialchars($testimonial['name']) ?>"
                                style="width:100px;height:100px;object-fit:cover;border-radius:6px;">

                        </div>

                    <?php endif; ?>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <div class="form-check form-switch mt-2">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="status"
                            value="1"
                            id="status"
                            <?= (int) $testimonial['status'] === 1 ? 'checked' : '' ?>>

                        <label
                            class="form-check-label"
                            for="status">
                            Active
                        </label>

                    </div>

                </div>

                <div class="col-12 mb-3">

                    <label class="form-label">
                        Testimonial Content
                        <span class="text-danger">*</span>
                    </label>

                    <textarea
                        name="content"
                        class="form-control"
                        rows="6"
                        maxlength="5000"
                        required><?= htmlspecialchars($testimonial['content']) ?></textarea>

                    <small class="text-muted">
                        Maximum 5000 characters.
                    </small>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-primary">
                <i class="bi bi-check-lg"></i>
                Update Testimonial
            </button>

            <a
                href="<?= $baseUrl ?>/admin/testimonials"
                class="btn btn-secondary">
                Cancel
            </a>

        </div>

    </form>

</div>