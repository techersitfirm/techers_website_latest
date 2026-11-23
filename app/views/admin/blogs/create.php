<form
    method="post"
    action="<?= $baseUrl ?>/admin/blogs/store"
    enctype="multipart/form-data"
    id="blogForm"
    novalidate>


<?= \app\helpers\Csrf::field() ?>


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
                    Image <span class="text-danger">*</span>
                </label>

                <input
                    type="file"
                    name="image"
                    id="image"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
                    required>

                <div class="form-text">
                    JPG, PNG or WebP.
                </div>

                <div class="invalid-feedback">
                    Please upload a blog image.
                </div>

            </div>


            <!-- Image Preview -->
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Preview
                </label>

                <div>

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
                    required></textarea>

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

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
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

            Save Blog

        </button>

        <a
            href="<?= $baseUrl ?>/admin/blogs"
            class="btn btn-secondary">

            Cancel

        </a>

    </div>

</div>


</form>

<?php \app\core\View::startSection('custom_js'); ?>

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

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');


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

        const value = input.value.trim();

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

        const value = input.value.trim();

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

        const description = document.getElementById('description');

        if (!description) {
            return false;
        }


        /*
         * Get Summernote HTML
         */
        let content = '';

        if (
            typeof $ !== 'undefined' &&
            $('#description').next('.note-editor').length
        ) {

            content = $('#description')
                .summernote('code')
                .trim();

        } else {

            content = description.value.trim();

        }


        /*
         * Remove HTML tags to check actual text
         */
        const textContent = content
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
     * Validate image
     * ---------------------------------------------------------
     */

    function validateImage() {

        if (!imageInput) {
            return false;
        }


        if (!imageInput.files.length) {

            imagePreview.src = '';
            imagePreview.style.display = 'none';

            setError(
                imageInput,
                'Blog image is required.'
            );

            return false;
        }


        const file = imageInput.files[0];

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        /*
         * File type
         */
        if (!allowedTypes.includes(file.type)) {

            imagePreview.src = '';
            imagePreview.style.display = 'none';

            setError(
                imageInput,
                'Only JPG, PNG and WebP images are allowed.'
            );

            return false;
        }


        /*
         * Preview
         */
        const previewUrl = URL.createObjectURL(file);

        imagePreview.src = previewUrl;
        imagePreview.style.display = 'block';


        clearError(imageInput);

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Select box change validation
     * ---------------------------------------------------------
     */

    [
        'is_active'
    ].forEach(function (id) {

        const input = document.getElementById(id);

        if (!input) {
            return;
        }

        input.addEventListener('change', function () {

            if (this.value.trim() !== '') {
                clearError(this);
            }

        });

    });


    /*
     * ---------------------------------------------------------
     * Title input validation
     * ---------------------------------------------------------
     */

    const titleInput = document.getElementById('title');

    if (titleInput) {

        titleInput.addEventListener('input', function () {

            if (this.value.trim() !== '') {
                clearError(this);
            }

        });

    }


    /*
     * ---------------------------------------------------------
     * Publish date validation
     * ---------------------------------------------------------
     */

    const publishDateInput =
        document.getElementById('publish_date');

    if (publishDateInput) {

        publishDateInput.addEventListener('change', function () {

            if (this.value.trim() !== '') {
                clearError(this);
            }

        });

    }


    /*
     * ---------------------------------------------------------
     * Image change
     * ---------------------------------------------------------
     */

    if (imageInput) {

        imageInput.addEventListener('change', function () {

            imagePreview.src = '';
            imagePreview.style.display = 'none';

            if (!this.files.length) {
                return;
            }

            validateImage();

        });

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
            placeholder: 'Write blog description...',

            callbacks: {

                onChange: function () {

                    const description =
                        document.getElementById('description');

                    const content = $('#description')
                        .summernote('code')
                        .trim();

                    const textContent = content
                        .replace(/<[^>]*>/g, '')
                        .replace(/&nbsp;/g, ' ')
                        .trim();


                    if (textContent !== '') {

                        description.setCustomValidity('');

                        $('#description')
                            .next('.note-editor')
                            .removeClass('is-invalid')
                            .addClass('is-valid');

                    }

                }

            }

        });

    }


    /*
     * ---------------------------------------------------------
     * Form submit
     * ---------------------------------------------------------
     */

    form.addEventListener('submit', function (event) {

        event.preventDefault();

        form.classList.add('was-validated');

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

        if (!validateDescription()) {

            valid = false;

        }


        /*
         * Publish Date
         */

        if (
            !validateRequired(
                document.getElementById('publish_date')
            )
        ) {

            valid = false;

        }


        /*
         * Status
         */

        if (
            !validateRequired(
                document.getElementById('is_active')
            )
        ) {

            valid = false;

        }


        /*
         * Image
         */

        if (!validateImage()) {

            valid = false;

        }


        /*
         * -----------------------------------------------------
         * Stop submission if anything is invalid
         * -----------------------------------------------------
         */

        if (!valid) {

            const invalidFields = [
                'title',
                'description',
                'publish_date',
                'is_active',
                'image'
            ];


            const firstInvalid = invalidFields
                .map(function (id) {
                    return document.getElementById(id);
                })
                .find(function (input) {

                    return input &&
                        (
                            input.classList.contains('is-invalid') ||
                            input.getAttribute('aria-invalid') === 'true' ||
                            input.validationMessage !== ''
                        );

                });


            if (firstInvalid) {

                /*
                 * Summernote requires scrolling to editor
                 */
                if (firstInvalid.id === 'description') {

                    const editor =
                        $('#description').next('.note-editor');

                    if (editor.length) {

                        editor[0].scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        editor.find('.note-editable').focus();

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
         * -----------------------------------------------------
         * Everything is valid.
         * Submit normally.
         * -----------------------------------------------------
         */

        form.submit();

    });

});

</script>

<?php \app\core\View::endSection(); ?>
