<div class="mb-4">
    <h5 class="mb-1">
        Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?>
    </h5>
    <div class="text-muted">
        <?= htmlspecialchars($_SESSION['user_type_name'] ?? 'User') ?> access
    </div>
</div>

<?php if (empty($dashboardCards)): ?>
    <div class="alert alert-warning">
        No dashboard access has been assigned yet.
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($dashboardCards as $card): ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <a href="<?= htmlspecialchars($card['url']) ?>" class="text-decoration-none text-reset">
                    <div class="card dashboard-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <div class="fs-3 text-primary">
                                    <i class="bi <?= htmlspecialchars($card['icon']) ?>"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1"><?= htmlspecialchars($card['title']) ?></h6>
                                    <p class="text-muted mb-0 small"><?= htmlspecialchars($card['text']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
