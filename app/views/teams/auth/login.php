<div class="row min-vh-100 justify-content-center align-items-center">

    <div class="col-lg-4 col-md-6">

        <div class="card shadow">

            <div class="card-body p-4">

                <div class="text-center mb-4">

                    <h2 class="team-brand">
                        Techers
                    </h2>

                    <p class="text-muted">
                        Login
                    </p>

                </div>

                <?php require VIEW_PATH . '/teams/partials/flash.php'; ?>

                <form
                    method="post"
                    action="<?= $baseUrl ?>/auth/login">

                    <div class="mb-3">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
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
