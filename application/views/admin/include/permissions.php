<div class="desjj1">
<div class="row set_spac2">
    <?php
    foreach ($defaultPermissions as $defaultPermission) {
    ?>
        <div class="col-sm-6 col-xs-12">
            <div class="box_blockk">
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
</div>
<input type="hidden" name="admin_id" value="<?= $admin_id; ?>" />
<div class="row">
    <div class="col-sm-12" class="responseMessage" id="permissionResponseMessage"></div>
</div>