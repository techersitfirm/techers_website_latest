<?php require __DIR__ . '/header.php'; ?>

<div class="team-wrapper">

    <?php require __DIR__ . '/sidebar.php'; ?>

    <div class="main-content">

        <div class="page-header-wrapper">

            <div class="page-header">

                <div></div>

                <div class="team-company-name">

                    <?= htmlspecialchars($_SESSION['user_type_name'] ?? 'Team') ?>

                </div>

                <a
                    href="<?= $baseUrl ?>/logout"
                    class="btn btn-outline-danger">

                    Logout

                </a>

            </div>
        </div>

        <div class="content-wrapper">

            <?php require VIEW_PATH . '/teams/partials/flash.php'; ?>
            <h2 class="mb-4">

                <?= $pageTitle ?? '' ?>

            </h2>
            <?= $content ?>

        </div>

        <?php require __DIR__ . '/footer-content.php'; ?>

    </div>

</div>

<?php require __DIR__ . '/footer.php'; ?>
