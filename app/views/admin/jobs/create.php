<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Add Job
        </h5>

        <a
            href="<?= $baseUrl ?>/admin/jobs"
            class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>

    </div>

    <div class="card-body">

        <form
            method="POST"
            action="<?= $baseUrl ?>/admin/jobs/store"
            enctype="multipart/form-data"
            id="jobForm">

            <?= \app\helpers\Csrf::field() ?>

            <div class="row">

                <!-- Job Title -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Job Title <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                        placeholder="Enter job title"
                        required>

                </div>


                <!-- Job Location -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Job Location <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="job_location"
                        class="form-control"
                        value="<?= htmlspecialchars($old['job_location'] ?? '') ?>"
                        placeholder="Enter job location"
                        required>

                </div>


                <!-- Qualification -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Qualification <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="qualification"
                        class="form-control"
                        value="<?= htmlspecialchars($old['qualification'] ?? '') ?>"
                        placeholder="Enter qualification"
                        required>

                </div>


                <!-- Job Date -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Job Date <span class="text-danger">*</span>
                    </label>

                    <input
                        type="date"
                        name="job_date"
                        class="form-control"
                        value="<?= htmlspecialchars($old['job_date'] ?? '') ?>"
                        required>

                </div>


                <!-- Job Brief -->
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Job Brief <span class="text-danger">*</span>
                    </label>

                    <textarea
                        name="job_brief"
                        class="form-control summernote"
                        rows="5"
                        placeholder="Enter job brief"
                        required><?= htmlspecialchars($old['job_brief'] ?? '') ?></textarea>

                </div>


                <!-- Roll / Skill -->
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Role / Skill <span class="text-danger">*</span>
                    </label>

                    <textarea
                        name="roll_skill"
                        class="form-control summernote"
                        rows="5"
                        placeholder="Enter role and skills"
                        required><?= htmlspecialchars($old['roll_skill'] ?? '') ?></textarea>

                </div>


                <!-- Perks & Benefits -->
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Perks & Benefits
                    </label>

                    <textarea
                        name="perks_benefits"
                        class="form-control summernote"
                        rows="5"
                        placeholder="Enter perks and benefits"><?= htmlspecialchars($old['perks_benefits'] ?? '') ?></textarea>

                </div>


                <!-- Requirements -->
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Requirements
                    </label>

                    <textarea
                        name="requirements"
                        class="form-control summernote"
                        rows="5"
                        placeholder="Enter job requirements"><?= htmlspecialchars($old['requirements'] ?? '') ?></textarea>

                </div>


                <!-- Image -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Job Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Allowed formats: JPG, JPEG, PNG, WEBP
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
                            checked>

                        <label
                            class="form-check-label"
                            for="status">
                            Active
                        </label>

                    </div>

                </div>

            </div>


            <!-- Submit -->
            <div class="mt-3">

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-save"></i>
                    Save Job

                </button>

                <a
                    href="<?= $baseUrl ?>/admin/jobs"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>