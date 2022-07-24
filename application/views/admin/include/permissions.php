<div class="row">
    <?php
    foreach ($defaultPermissions as $defaultPermission) {
    ?>
        <div class="form-group">
            <div class="col-sm-3">
                <label><?= $defaultPermission['comment']; ?></label>
                <select type="select" class="form-control" name="<?= $defaultPermission['permission']; ?>">
                    <option value="0"> Blocked </option>
                    <option value="1" <?= ($adminPermissions[$defaultPermission['id']]) ? 'selected' : ''; ?>> Allowed </option>
                </select>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<input type="hidden" name="admin_id" value="<?= $admin_id; ?>" />
<div class="row">
    <div class="col-sm-12" class="responseMessage" id="permissionResponseMessage"></div>
</div>