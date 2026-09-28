<?php $isEdit = !empty($userType); ?>

<form
    method="post"
    action="<?= $baseUrl ?>/admin/user-types/<?= $isEdit ? 'update' : 'store' ?>">

    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int) $userType['id'] ?>">
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">User Type Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?= htmlspecialchars($userType['name'] ?? '') ?>"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Description</label>
                    <input
                        type="text"
                        name="description"
                        class="form-control"
                        value="<?= htmlspecialchars($userType['description'] ?? '') ?>">
                </div>

                <?php if ($isEdit): ?>
                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch mt-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                id="is_active"
                                <?= $userType['is_active'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <?= $isEdit ? 'Update User Type' : 'Save User Type' ?>
            </button>
            <a href="<?= $baseUrl ?>/admin/user-types" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
