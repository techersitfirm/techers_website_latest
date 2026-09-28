<?php require __DIR__ . '/header.php'; ?>

<div class="admin-wrapper">

    <?php require __DIR__ . '/sidebar.php'; ?>

    <div class="main-content">

    <div class="page-header-wrapper">

        <div class="page-header">

            <h2 class="mb-0">
                <?= $pageTitle ?? 'Dashboard'; ?>
            </h2>

            <a
                href="<?= $baseUrl ?>/admin/logout"
                class="btn btn-outline-danger">

                Logout

            </a>

        </div>

    </div>

    <div class="content-wrapper">

        <?php require VIEW_PATH . '/admin/partials/flash.php'; ?>

        <?= $content ?>

    </div>

</div>

</div>

<?php require __DIR__ . '/footer.php'; ?>