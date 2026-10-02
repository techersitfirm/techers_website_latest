<form
    method="post"
    action="<?= $baseUrl ?>/admin/teams/update"
    enctype="multipart/form-data"
    id="teamForm"
    novalidate>
<?= \app\helpers\Csrf::field() ?>

<input
    type="hidden"
    name="token"
    value="<?= htmlspecialchars($_GET['token'] ?? '') ?>">

<div class="card">
    <div class="card-body">
        <div class="row">

            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Name <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="<?= htmlspecialchars($team['name'] ?? '') ?>"
                    required
                    minlength="2"
                    maxlength="100">

                <div class="invalid-feedback">
                    Please enter a valid name.
                </div>
            </div>


            <!-- Mobile -->
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Mobile <span class="text-danger">*</span>
                </label>

                <input
                    type="tel"
                    name="mobile"
                    id="mobile"
                    class="form-control"
                    value="<?= htmlspecialchars($team['mobile'] ?? '') ?>"
                    required
                    maxlength="10"
                    inputmode="numeric">

                <div class="invalid-feedback">
                    Please enter a valid 10-digit mobile number.
                </div>
            </div>


            <!-- Email -->
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Email <span class="text-danger">*</span>
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    value="<?= htmlspecialchars($team['email'] ?? '') ?>"
                    required
                    maxlength="255">

                <div class="invalid-feedback">
                    Please enter a valid email address.
                </div>
            </div>


            <!-- Password -->
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    minlength="8"
                    maxlength="20">

                <div class="form-text">
                    Leave blank to keep the current password.
                </div>

                <div class="invalid-feedback">
                    Password must be at least 8 characters.
                </div>
            </div>


            <!-- User Type -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    User Type <span class="text-danger">*</span>
                </label>

                <select
                    name="user_type_id"
                    id="user_type_id"
                    class="form-select"
                    required>

                    <option value="">Select User Type</option>

                    <?php foreach ($userTypes as $userType): ?>
                        <option
                            value="<?= (int) $userType['id']; ?>"
                            <?= (int) ($team['user_type_id'] ?? 0) === (int) $userType['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($userType['name']); ?>
                        </option>
                    <?php endforeach; ?>

                </select>

                <div class="invalid-feedback">
                    Please select a user type.
                </div>
            </div>


            <!-- Post -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Post <span class="text-danger">*</span>
                </label>

                <select
                    name="post_id"
                    id="post_id"
                    class="form-select"
                    required>

                    <option value="">Select Post</option>

                    <?php foreach ($posts as $post): ?>
                        <option
                            value="<?= (int) $post['id']; ?>"
                            <?= (int) ($team['post_id'] ?? 0) === (int) $post['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($post['name']); ?>
                        </option>
                    <?php endforeach; ?>

                </select>

                <div class="invalid-feedback">
                    Please select a post.
                </div>
            </div>


            <!-- Show on Website -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Show on Website <span class="text-danger">*</span>
                </label>

                <select
                    name="show_on_website"
                    id="show_on_website"
                    class="form-select"
                    required>

                    <option value="">Select Option</option>

                    <option
                        value="1"
                        <?= (int) ($team['show_on_website'] ?? 0) === 1 ? 'selected' : '' ?>>
                        Yes
                    </option>

                    <option
                        value="0"
                        <?= isset($team['show_on_website']) && (int) $team['show_on_website'] === 0 ? 'selected' : '' ?>>
                        No
                    </option>

                </select>

                <div class="invalid-feedback">
                    Please select whether this team member should be shown on the website.
                </div>
            </div>


            <!-- Address -->
            <div class="col-md-12 mb-3">
                <label class="form-label">
                    Address
                </label>

                <textarea
                    name="address"
                    id="address"
                    class="form-control"
                    rows="3"
                    maxlength="1000"><?= htmlspecialchars($team['address'] ?? '') ?></textarea>
            </div>


            <!-- City -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    City
                </label>

                <input
                    type="text"
                    name="city"
                    id="city"
                    class="form-control"
                    maxlength="100"
                    value="<?= htmlspecialchars($team['city'] ?? '') ?>">
            </div>


            <!-- State -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    State
                </label>

                <select
                    name="state_id"
                    id="state_id"
                    class="form-select">

                    <option value="">Select State</option>

                    <?php foreach ($states as $state): ?>
                        <option
                            value="<?= (int) $state['id']; ?>"
                            <?= (int) ($team['state_id'] ?? 0) === (int) $state['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($state['name']); ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>


            <!-- Country -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Country
                </label>

                <input
                    type="text"
                    name="country"
                    id="country"
                    class="form-control"
                    maxlength="100"
                    value="<?= htmlspecialchars($team['country'] ?? '') ?>">
            </div>


            <!-- Instagram -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Instagram
                </label>

                <input
                    type="url"
                    name="instagram"
                    id="instagram"
                    class="form-control"
                    maxlength="500"
                    value="<?= htmlspecialchars($team['instagram'] ?? '') ?>"
                    placeholder="https://instagram.com/username">

                <div class="invalid-feedback">
                    Please enter a valid Instagram URL.
                </div>
            </div>


            <!-- Facebook -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Facebook
                </label>

                <input
                    type="url"
                    name="facebook"
                    id="facebook"
                    class="form-control"
                    maxlength="500"
                    value="<?= htmlspecialchars($team['facebook'] ?? '') ?>"
                    placeholder="https://facebook.com/username">

                <div class="invalid-feedback">
                    Please enter a valid Facebook URL.
                </div>
            </div>


            <!-- LinkedIn -->
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    LinkedIn
                </label>

                <input
                    type="url"
                    name="linkedin"
                    id="linkedin"
                    class="form-control"
                    maxlength="500"
                    value="<?= htmlspecialchars($team['linkedin'] ?? '') ?>"
                    placeholder="https://linkedin.com/in/username">

                <div class="invalid-feedback">
                    Please enter a valid LinkedIn URL.
                </div>
            </div>


            <!-- Profile Photo -->
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Profile Photo
                </label>

                <input
                    type="file"
                    name="profile_pic"
                    id="profile_pic"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp">

                <div class="form-text">
                    Optional. If you do not select a new photo, the current photo will be kept.
                    Exactly <strong>791 × 791 px</strong>.
                    Maximum <strong>2 MB</strong>.
                    JPG, PNG or WebP.
                </div>

                <div class="invalid-feedback">
                    Please upload a valid 791 × 791 px image.
                </div>
            </div>


            <!-- Current / New Photo Preview -->
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Preview
                </label>

                <div>
                    <?php if (!empty($team['profile_pic'])): ?>

                        <img
                            id="profilePreview"
                            src="<?= $baseUrl ?>/<?= htmlspecialchars($team['profile_pic']) ?>"
                            alt="Current Profile"
                            class="img-thumbnail"
                            style="
                                width:150px;
                                height:150px;
                                object-fit:cover;
                            ">

                    <?php else: ?>

                        <img
                            id="profilePreview"
                            src=""
                            alt="Profile Preview"
                            class="img-thumbnail"
                            style="
                                width:150px;
                                height:150px;
                                object-fit:cover;
                                display:none;
                            ">

                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>


    <div class="card-footer">

        <button
            type="submit"
            class="btn btn-primary">
            Update Team
        </button>

        <a
            href="<?= $baseUrl ?>/admin/teams"
            class="btn btn-secondary">
            Cancel
        </a>

    </div>
</div>

</form>

<?php \app\core\View::startSection('custom_js'); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('teamForm');

    if (!form) {
        return;
    }


    const photoInput = document.getElementById('profile_pic');
    const photoPreview = document.getElementById('profilePreview');

    const MAX_FILE_SIZE = 2 * 1024 * 1024;
    const IMAGE_SIZE = 791;


    const socialDomains = {
        instagram: 'instagram.com',
        facebook: 'facebook.com',
        linkedin: 'linkedin.com'
    };


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
     * Validate name
     * ---------------------------------------------------------
     */
    function validateName(input) {

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

        if (
            value.length < 2 ||
            !/^[A-Za-z\s]+$/.test(value)
        ) {

            setError(
                input,
                'Please enter a valid name.'
            );

            return false;
        }

        clearError(input);

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Validate mobile
     * ---------------------------------------------------------
     */
    function validateMobile(input) {

        if (!input) {
            return false;
        }

        const value = input.value.trim();

        if (!/^[6-9][0-9]{9}$/.test(value)) {

            setError(
                input,
                'Please enter a valid 10-digit mobile number.'
            );

            return false;
        }

        clearError(input);

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Validate email
     * ---------------------------------------------------------
     */
    function validateEmail(input) {

        if (!input) {
            return false;
        }

        const value = input.value.trim();

        const validEmail =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);

        if (!validEmail) {

            setError(
                input,
                'Please enter a valid email address.'
            );

            return false;
        }

        clearError(input);

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Validate password
     *
     * EDIT FORM:
     * Blank password = keep existing password.
     * ---------------------------------------------------------
     */
    function validatePassword(input) {

        if (!input) {
            return false;
        }

        const value = input.value.trim();

        // Blank password is valid during edit.
        if (value === '') {

            input.setCustomValidity('');

            input.classList.remove(
                'is-invalid',
                'is-valid'
            );

            return true;
        }

        // If user entered a password, it must be
        // at least 8 characters.
        if (value.length < 8) {

            setError(
                input,
                'Password must be at least 8 characters.'
            );

            return false;
        }

        clearError(input);

        return true;
    }


    /*
     * ---------------------------------------------------------
     * Validate social URL
     * ---------------------------------------------------------
     */
    function validateSocial(input, domain) {

        if (!input) {
            return false;
        }

        const value = input.value.trim();

        // Social links are optional.
        if (value === '') {

            input.setCustomValidity('');

            input.classList.remove(
                'is-invalid',
                'is-valid'
            );

            return true;
        }

        try {

            const url = new URL(value);

            const hostname = url.hostname
                .toLowerCase()
                .replace(/^www\./, '');

            if (
                !['http:', 'https:'].includes(url.protocol) ||
                hostname !== domain
            ) {
                throw new Error();
            }

            clearError(input);

            return true;

        } catch (error) {

            setError(
                input,
                'Please enter a valid social media URL.'
            );

            return false;
        }
    }


    /*
     * ---------------------------------------------------------
     * Validate profile photo
     *
     * EDIT FORM:
     * No new photo = keep current photo.
     * New photo = validate it.
     * ---------------------------------------------------------
     */
    function validatePhoto() {

        if (!photoInput) {
            return Promise.resolve(true);
        }


        /*
         * No new photo selected.
         *
         * This is valid during edit because the existing
         * profile photo should remain unchanged.
         */
        if (!photoInput.files.length) {

            photoInput.setCustomValidity('');

            photoInput.classList.remove(
                'is-invalid',
                'is-valid'
            );

            return Promise.resolve(true);
        }


        const file = photoInput.files[0];


        /*
         * Allowed file types
         */
        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        if (!allowedTypes.includes(file.type)) {

            setError(
                photoInput,
                'Only JPG, PNG and WebP images are allowed.'
            );

            return Promise.resolve(false);
        }


        /*
         * File size
         */
        if (file.size > MAX_FILE_SIZE) {

            setError(
                photoInput,
                'Profile photo must not exceed 2 MB.'
            );

            return Promise.resolve(false);
        }


        /*
         * Show preview
         */
        const previewUrl =
            URL.createObjectURL(file);

        photoPreview.src = previewUrl;
        photoPreview.style.display = 'block';


        /*
         * Check image dimensions
         */
        return new Promise(function (resolve) {

            const image = new Image();

            image.onload = function () {

                if (
                    image.width !== IMAGE_SIZE ||
                    image.height !== IMAGE_SIZE
                ) {

                    setError(
                        photoInput,
                        'Profile photo must be exactly 791 × 791 pixels.'
                    );

                    resolve(false);
                    return;
                }


                /*
                 * Valid image
                 */
                clearError(photoInput);

                resolve(true);
            };


            image.onerror = function () {

                setError(
                    photoInput,
                    'Invalid image file.'
                );

                resolve(false);
            };


            image.src = previewUrl;

        });
    }


    /*
     * ---------------------------------------------------------
     * Select box change validation
     *
     * This fixes the issue where selecting an option
     * still showed the previous validation error.
     * ---------------------------------------------------------
     */
    [
        'user_type_id',
        'post_id',
        'show_on_website'
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
     * Name input
     * ---------------------------------------------------------
     */
    const nameInput =
        document.getElementById('name');

    if (nameInput) {

        nameInput.addEventListener('input', function () {

            if (this.value.trim() !== '') {
                clearError(this);
            }

        });

    }


    /*
     * ---------------------------------------------------------
     * Mobile input
     * ---------------------------------------------------------
     */
    const mobileInput =
        document.getElementById('mobile');

    if (mobileInput) {

        mobileInput.addEventListener('input', function () {

            this.value =
                this.value.replace(/\D/g, '');

            if (
                /^[6-9][0-9]{9}$/.test(this.value)
            ) {
                clearError(this);
            }

        });

    }


    /*
     * ---------------------------------------------------------
     * Email input
     * ---------------------------------------------------------
     */
    const emailInput =
        document.getElementById('email');

    if (emailInput) {

        emailInput.addEventListener('input', function () {

            const value =
                this.value.trim();

            if (
                /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
            ) {
                clearError(this);
            }

        });

    }


    /*
     * ---------------------------------------------------------
     * Password input
     * ---------------------------------------------------------
     */
    const passwordInput =
        document.getElementById('password');

    if (passwordInput) {

        passwordInput.addEventListener('input', function () {

            const value =
                this.value.trim();

            // Empty = valid for edit.
            if (value === '') {

                this.setCustomValidity('');

                this.classList.remove(
                    'is-invalid',
                    'is-valid'
                );

                return;
            }

            if (value.length >= 8) {
                clearError(this);
            }

        });

    }


    /*
     * ---------------------------------------------------------
     * Social media input
     * ---------------------------------------------------------
     */
    Object.entries(socialDomains).forEach(
        function ([id, domain]) {

            const input =
                document.getElementById(id);

            if (!input) {
                return;
            }

            input.addEventListener('input', function () {

                if (this.value.trim() === '') {

                    this.setCustomValidity('');

                    this.classList.remove(
                        'is-invalid',
                        'is-valid'
                    );

                    return;
                }

                validateSocial(this, domain);

            });

        }
    );


    /*
     * ---------------------------------------------------------
     * Profile photo change
     * ---------------------------------------------------------
     */
    if (photoInput) {

        photoInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {
                return;
            }

            const previewUrl =
                URL.createObjectURL(file);

            photoPreview.src = previewUrl;
            photoPreview.style.display = 'block';

        });

    }


    /*
     * ---------------------------------------------------------
     * Form submit
     * ---------------------------------------------------------
     */
    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        form.classList.add('was-validated');

        let valid = true;


        /*
         * Name
         */
        if (
            !validateName(
                document.getElementById('name')
            )
        ) {
            valid = false;
        }


        /*
         * Mobile
         */
        if (
            !validateMobile(
                document.getElementById('mobile')
            )
        ) {
            valid = false;
        }


        /*
         * Email
         */
        if (
            !validateEmail(
                document.getElementById('email')
            )
        ) {
            valid = false;
        }


        /*
         * Password
         *
         * Blank is allowed during edit.
         */
        if (
            !validatePassword(
                document.getElementById('password')
            )
        ) {
            valid = false;
        }


        /*
         * User Type
         */
        if (
            !validateRequired(
                document.getElementById('user_type_id')
            )
        ) {
            valid = false;
        }


        /*
         * Post
         */
        if (
            !validateRequired(
                document.getElementById('post_id')
            )
        ) {
            valid = false;
        }


        /*
         * Show on Website
         */
        if (
            !validateRequired(
                document.getElementById('show_on_website')
            )
        ) {
            valid = false;
        }


        /*
         * -----------------------------------------------------
         * Address / City / State / Country
         *
         * NO VALIDATION
         * -----------------------------------------------------
         */


        /*
         * Social media
         */
        Object.entries(socialDomains).forEach(
            function ([id, domain]) {

                if (
                    !validateSocial(
                        document.getElementById(id),
                        domain
                    )
                ) {
                    valid = false;
                }

            }
        );


        /*
         * Profile photo
         *
         * Optional during edit.
         */
        const photoValid =
            await validatePhoto();

        if (!photoValid) {
            valid = false;
        }


        /*
         * -----------------------------------------------------
         * Stop submission if anything is invalid
         * -----------------------------------------------------
         */
        if (!valid) {

            const invalidFields = [
                'name',
                'mobile',
                'email',
                'password',
                'user_type_id',
                'post_id',
                'show_on_website',
                'instagram',
                'facebook',
                'linkedin',
                'profile_pic'
            ];


            const firstInvalid = invalidFields
                .map(function (id) {
                    return document.getElementById(id);
                })
                .find(function (input) {

                    return input &&
                        input.classList.contains('is-invalid');

                });


            if (firstInvalid) {

                firstInvalid.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                firstInvalid.focus();

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
