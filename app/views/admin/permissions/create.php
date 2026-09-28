<form method="post" action="<?= $baseUrl ?>/admin/permissions/store">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Module</label>
                    <input type="text" name="module" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Permission Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Slug</label>
                    <input
                        type="text"
                        name="slug"
                        class="form-control"
                        placeholder="module.action"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save Permission</button>
            <a href="<?= $baseUrl ?>/admin/permissions" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
