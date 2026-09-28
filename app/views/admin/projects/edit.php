<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Edit Project
        </h5>

        <a
            href="<?= $baseUrl ?>/admin/projects"
            class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Back

        </a>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="<?= $baseUrl ?>/admin/projects/update"
            enctype="multipart/form-data">

            <?= \App\Helpers\Csrf::field() ?>

            <input
                type="hidden"
                name="token"
                value="<?= htmlspecialchars($project['token'] ?? '') ?>">

            <div class="row">

                <!-- Name -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Project Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?= htmlspecialchars($project['name'] ?? '') ?>"
                        placeholder="Enter project name"
                        required>

                </div>


                <!-- Project Type -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Project Type <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="project_type"
                        class="form-control"
                        value="<?= htmlspecialchars($project['project_type'] ?? '') ?>"
                        placeholder="Enter project type"
                        required>

                </div>


                <!-- Link -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Project Link
                    </label>

                    <input
                        type="url"
                        name="link"
                        class="form-control"
                        value="<?= htmlspecialchars($project['link'] ?? '') ?>"
                        placeholder="https://example.com">

                </div>


                <!-- Image -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Project Image
                    </label>

                    <?php if (!empty($project['ProfilePic'])): ?>

                        <div class="mb-2">

                            <img
                                src="<?= $baseUrl ?>/<?= htmlspecialchars($project['ProfilePic']) ?>"
                                alt="<?= htmlspecialchars($project['name'] ?? 'Project Image') ?>"
                                width="100"
                                height="100"
                                class="rounded object-fit-cover">

                        </div>

                    <?php endif; ?>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Leave empty to keep the existing image.
                    </small>

                </div>


                <!-- Status -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <div class="form-check form-switch mt-2">

                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            class="form-check-input"
                            id="status"
                            <?= ((int) ($project['status'] ?? 0) === 1)
                                ? 'checked'
                                : '' ?>>

                        <label
                            class="form-check-label"
                            for="status">

                            Active

                        </label>

                    </div>

                </div>

            </div>


            <div class="mt-3">

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-save"></i>
                    Update Project

                </button>

                <a
                    href="<?= $baseUrl ?>/admin/projects"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>