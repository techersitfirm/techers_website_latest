<div class="container">

    <div
        class="row min-vh-100 justify-content-center align-items-center">

        <div class="col-lg-4 col-md-6">

            <div class="card border-0 shadow-lg">

                <div class="card-body p-4">

                    <div class="text-center mb-4">

                        <h2 class="fw-bold">
                            Techers
                        </h2>

                        <p class="text-muted mb-0">
                        Login
                        </p>

                    </div>
                    <?php require VIEW_PATH . '/admin/partials/flash.php'; ?>

                    <form
                        method="post"
                        action="<?= BASE_URL ?>/auth/login">

                        <div class="mb-3">

                            <label
                                class="form-label">

                                Email Address

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label
                                class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
