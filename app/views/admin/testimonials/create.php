<?php
$baseUrl = BASE_URL;
?>

<div class="card">

    <div class="card-header">
        <h5 class="mb-0">Add Testimonial</h5>
    </div>

    <form
        method="POST"
        action="<?= $baseUrl ?>/admin/testimonials/store"
        enctype="multipart/form-data">

        <?= \App\Helpers\Csrf::field() ?>

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
                        value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
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
                        value="<?= htmlspecialchars($_POST['type'] ?? '') ?>"
                        placeholder="e.g. Patient, Client, Google Review"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Testimonial Image
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        required>

                    <small class="text-muted">
                        JPG, JPEG, PNG or WEBP. Maximum 2 MB.
                    </small>

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
                            checked>

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
                        required><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>

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
                Save Testimonial
            </button>

            <a
                href="<?= $baseUrl ?>/admin/testimonials"
                class="btn btn-secondary">
                Cancel
            </a>

        </div>

    </form>

</div>