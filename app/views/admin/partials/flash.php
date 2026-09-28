<?php if (!empty($flash)): ?>

<div
    id="flashMessage"
    class="alert alert-<?= htmlspecialchars($flash['type']) ?> alert-dismissible fade show"
    role="alert">

    <?= htmlspecialchars($flash['message']) ?>

</div>

<script>
setTimeout(function () {

    const flash =
        document.getElementById(
            'flashMessage'
        );

    if (flash) {

        flash.classList.remove(
            'show'
        );

        setTimeout(function () {

            flash.remove();

        }, 300);

    }

}, 3000);
</script>

<?php endif; ?>