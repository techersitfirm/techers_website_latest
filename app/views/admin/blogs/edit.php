<form
    method="post"
    action="<?= $baseUrl ?>/admin/blogs/update"
    enctype="multipart/form-data"
    id="blogForm"
    novalidate>

    <?= \App\Helpers\Csrf::field() ?>

    <input
        type="hidden"
        name="token"
        value="<?= htmlspecialchars($blog['token'] ?? '') ?>">


    <div class="card">

        <div class="card-body">

            <div class="row">


                <!-- Title -->
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Title <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        value="<?= htmlspecialchars($blog['title'] ?? '') ?>"
                        required
                        minlength="2"
                        maxlength="255">

                    <div class="invalid-feedback">
                        Please enter a valid blog title.
                    </div>

                </div>


                <!-- Image -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp">

                    <div class="form-text">
                        JPG, PNG or WebP. Leave blank to keep the current image.
                    </div>

                    <div class="invalid-feedback">
                        Please upload a valid blog image.
                    </div>

                </div>


                <!-- Current / New Blog Image Preview -->
<div class="col-md-6 mb-3">

    <label class="form-label">
        Preview
    </label>

    <div>

        <?php if (!empty($blog['intro_image'])): ?>

            <img
                id="imagePreview"
                src="<?= $baseUrl ?>/<?= htmlspecialchars($blog['intro_image']) ?>"
                alt="<?= htmlspecialchars($blog['title'] ?? 'Blog Image') ?>"
                class="img-thumbnail"
                style="
                    width: 200px;
                    height: 120px;
                    object-fit: cover;
                ">

        <?php else: ?>

            <img
                id="imagePreview"
                src=""
                alt="Blog Image Preview"
                class="img-thumbnail"
                style="
                    width: 200px;
                    height: 120px;
                    object-fit: cover;
                    display: none;
                ">

        <?php endif; ?>

    </div>

</div>

                <!-- Description -->
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Description <span class="text-danger">*</span>
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        required><?= htmlspecialchars($blog['description'] ?? '') ?></textarea>

                    <div class="invalid-feedback">
                        Please enter the blog description.
                    </div>

                </div>


                <!-- Date of Publish -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Date of Publish <span class="text-danger">*</span>
                    </label>

                    <input
                        type="date"
                        name="publish_date"
                        id="publish_date"
                        class="form-control"
                        value="<?= htmlspecialchars($blog['blog_date'] ?? '') ?>"
                        required>

                    <div class="invalid-feedback">
                        Please select the publish date.
                    </div>

                </div>


                <!-- Status -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Status <span class="text-danger">*</span>
                    </label>

                    <select
                        name="is_active"
                        id="is_active"
                        class="form-select"
                        required>

                        <option value="">
                            Select Status
                        </option>

                        <option
                            value="1"
                            <?= ((int) ($blog['is_active'] ?? 0) === 1) ? 'selected' : '' ?>>
                            Active
                        </option>

                        <option
                            value="0"
                            <?= isset($blog['is_active']) && (int) $blog['is_active'] === 0 ? 'selected' : '' ?>>
                            Inactive
                        </option>

                    </select>

                    <div class="invalid-feedback">
                        Please select the blog status.
                    </div>

                </div>


            </div>

        </div>


        <div class="card-footer">

            <button
                type="submit"
                class="btn btn-primary">

                Update Blog

            </button>

            <a
                href="<?= $baseUrl ?>/admin/blogs"
                class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </div>

</form>


<?php \App\Core\View::startSection('custom_js'); ?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('blogForm');

    if (!form) {
        return;
    }


    /*
     * ---------------------------------------------------------
     * Image
     * ---------------------------------------------------------
     */

    const imageInput =
        document.getElementById('image');

    const imagePreview =
        document.getElementById('imagePreview');


    /*
     * ---------------------------------------------------------
     * Set validation error
     * ---------------------------------------------------------
     */

    function setError(input, message) {

        if (!input) {
            return;
        }

        input.setCustomValidity(message);

        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }


    /*
     * ---------------------------------------------------------
     * Clear validation error
     * ---------------------------------------------------------
     */

    function clearError(input) {

        if (!input) {
            return;
        }

        input.setCustomValidity('');

        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    }


    /*
     * ---------------------------------------------------------
     * Validate required field
     * ---------------------------------------------------------
     */

    function validateRequired(input) {

        if (!input) {
            return false;
        }

        const value =
            input.value.trim();

        if (value === '') {

            setError(
                input,
                'This field is required.'
            );

            return false;
        }

        clearError(input);

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Validate title
     * ---------------------------------------------------------
     */

    function validateTitle(input) {

        if (!input) {
            return false;
        }

        const value =
            input.value.trim();

        if (value === '') {

            setError(
                input,
                'Blog title is required.'
            );

            return false;
        }


        if (value.length < 2) {

            setError(
                input,
                'Blog title must be at least 2 characters.'
            );

            return false;
        }


        clearError(input);

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Validate Summernote description
     * ---------------------------------------------------------
     */

    function validateDescription() {

        const description =
            document.getElementById('description');

        if (!description) {
            return false;
        }


        let content = '';


        if (
            typeof $ !== 'undefined' &&
            $('#description').next('.note-editor').length
        ) {

            content =
                $('#description')
                    .summernote('code')
                    .trim();

        } else {

            content =
                description.value.trim();
        }


        const textContent =
            content
                .replace(/<[^>]*>/g, '')
                .replace(/&nbsp;/g, ' ')
                .trim();


        if (textContent === '') {

            description.setCustomValidity(
                'Description is required.'
            );

            $('#description')
                .next('.note-editor')
                .addClass('is-invalid');

            return false;
        }


        description.setCustomValidity('');

        $('#description')
            .next('.note-editor')
            .removeClass('is-invalid')
            .addClass('is-valid');

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Validate Image
     *
     * Image is OPTIONAL during edit.
     * If no new image is selected, existing image remains.
     * ---------------------------------------------------------
     */

    function validateImage() {

        if (!imageInput) {
            return true;
        }


        /*
         * No new image selected.
         *
         * Existing image is already available,
         * so this is valid.
         */
        if (!imageInput.files.length) {

            imageInput.setCustomValidity('');

            imageInput.classList.remove(
                'is-invalid',
                'is-valid'
            );

            return true;
        }


        const file =
            imageInput.files[0];


        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        /*
         * File type
         */
        if (
            !allowedTypes.includes(file.type)
        ) {

            setError(
                imageInput,
                'Only JPG, PNG and WebP images are allowed.'
            );

            return false;
        }


        /*
         * Maximum 2 MB
         */
        if (
            file.size > 2 * 1024 * 1024
        ) {

            setError(
                imageInput,
                'Image must not exceed 2 MB.'
            );

            return false;
        }


        /*
         * Preview new image
         */
        const previewUrl =
            URL.createObjectURL(file);

        imagePreview.src =
            previewUrl;

        imagePreview.style.display =
            'block';


        clearError(imageInput);

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Status change
     * ---------------------------------------------------------
     */

    const statusInput =
        document.getElementById('is_active');

    if (statusInput) {

        statusInput.addEventListener(
            'change',
            function () {

                if (
                    this.value.trim() !== ''
                ) {

                    clearError(this);
                }

            }
        );

    }


    /*
     * ---------------------------------------------------------
     * Title
     * ---------------------------------------------------------
     */

    const titleInput =
        document.getElementById('title');

    if (titleInput) {

        titleInput.addEventListener(
            'input',
            function () {

                if (
                    this.value.trim() !== ''
                ) {

                    clearError(this);
                }

            }
        );

    }


    /*
     * ---------------------------------------------------------
     * Publish Date
     * ---------------------------------------------------------
     */

    const publishDateInput =
        document.getElementById('publish_date');

    if (publishDateInput) {

        publishDateInput.addEventListener(
            'change',
            function () {

                if (
                    this.value.trim() !== ''
                ) {

                    clearError(this);
                }

            }
        );

    }


    /*
     * ---------------------------------------------------------
     * Image Change
     * ---------------------------------------------------------
     */

    if (imageInput) {

        imageInput.addEventListener(
            'change',
            function () {

                if (!this.files.length) {
                    return;
                }

                validateImage();

            }
        );

    }


    /*
     * ---------------------------------------------------------
     * Initialize Summernote
     * ---------------------------------------------------------
     */

    if (
        typeof $ !== 'undefined' &&
        typeof $.fn.summernote !== 'undefined'
    ) {

        $('#description').summernote({

            height: 300,

            placeholder:
                'Write blog description...',

            callbacks: {

                onChange: function () {

                    validateDescription();

                }

            }

        });

    }


    /*
     * ---------------------------------------------------------
     * Form Submit
     * ---------------------------------------------------------
     */

    form.addEventListener(
        'submit',
        function (event) {

            event.preventDefault();

            form.classList.add(
                'was-validated'
            );

            let valid = true;


            /*
             * Title
             */

            if (
                !validateTitle(
                    document.getElementById('title')
                )
            ) {

                valid = false;
            }


            /*
             * Description
             */

            if (
                !validateDescription()
            ) {

                valid = false;
            }


            /*
             * Publish Date
             */

            if (
                !validateRequired(
                    document.getElementById(
                        'publish_date'
                    )
                )
            ) {

                valid = false;
            }


            /*
             * Status
             */

            if (
                !validateRequired(
                    document.getElementById(
                        'is_active'
                    )
                )
            ) {

                valid = false;
            }


            /*
             * Image
             *
             * Optional during edit.
             */

            if (
                !validateImage()
            ) {

                valid = false;
            }


            /*
             * -------------------------------------------------
             * Invalid field handling
             * -------------------------------------------------
             */

            if (!valid) {

                const invalidFields = [
                    'title',
                    'description',
                    'publish_date',
                    'is_active',
                    'image'
                ];


                const firstInvalid =
                    invalidFields
                        .map(function (id) {

                            return document.getElementById(
                                id
                            );

                        })
                        .find(function (input) {

                            return input &&
                                (
                                    input.classList.contains(
                                        'is-invalid'
                                    ) ||
                                    input.getAttribute(
                                        'aria-invalid'
                                    ) === 'true' ||
                                    input.validationMessage !== ''
                                );

                        });


                if (firstInvalid) {


                    /*
                     * Summernote
                     */

                    if (
                        firstInvalid.id ===
                        'description'
                    ) {

                        const editor =
                            $('#description')
                                .next('.note-editor');


                        if (editor.length) {

                            editor[0].scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });

                            editor
                                .find('.note-editable')
                                .focus();

                        }


                    } else {

                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        firstInvalid.focus();

                    }

                }

                return;
            }


            /*
             * -------------------------------------------------
             * Everything valid
             * -------------------------------------------------
             */

            form.submit();

        }
    );

});

</script>

<?php \App\Core\View::endSection(); ?>