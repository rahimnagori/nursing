<div class="sidebar">
  <div class="sidebar2">
    <ul class="ul_set">
      <li>
        <a href="<?= site_url('Dashboard'); ?>"><i class="fa fa-tachometer"></i> Dashboard</a>
      </li>
      <?php
      if (isset($permissions[4]) && $permissions[4]) {
      ?>
      <?php
      }
      ?>
      <?php
      if (isset($permissions[4]) && $permissions[4]) {
      ?>
        <li>
          <a href="<?= site_url('Users-Management'); ?>"><i class="fa fa-user"></i> Users</a>
        </li>
      <?php
      }
      ?>
      <?php
      if (isset($permissions[1]) && $permissions[1]) {
      ?>
        <li>
          <a href="<?= site_url('Admins-Management'); ?>"><i class="fa fa-user"></i> Admins Management</a>
        </li>
      <?php
      }
      ?>
      <?php
      if (isset($permissions[7]) && $permissions[7] || isset($permissions[10]) && $permissions[10]) {
      ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-briefcase"></i>
            Jobs Management
          </a>
          <ul class="dropdown-menu">

            <?php
            if (isset($permissions[7]) && $permissions[7]) {
            ?>
              <li>
                <a href="<?= site_url('Admin-Jobs'); ?>"><i class="fa fa-dot-circle-o"></i> Jobs</a>
              </li>
            <?php
            }
            ?>

            <?php
            if (isset($permissions[10]) && $permissions[10]) {
            ?>
              <li>
                <a href="<?= site_url('Job-Types'); ?>"><i class="fa fa-dot-circle-o"></i> Work Location</a>
              </li>
            <?php
            }
            ?>
          </ul>
        </li>
      <?php
      }
      ?>
      <?php
      if (isset($permissions[28]) && $permissions[28]) {
      ?>
        <li>
          <a href="<?= site_url('Job-Applications'); ?>"><i class="fa fa-file-text-o"></i> Job Applications</a>
        </li>
      <?php
      }
      ?>

      <?php
      if (isset($permissions[16]) && $permissions[16]) {
      ?>
        <li>
          <a href="<?= site_url('Admin-Contact'); ?>"><i class="fa fa-comments-o"></i> Contact Requests</a>
        </li>
      <?php
      }
      ?>

      <?php
      if (isset($permissions[19]) && $permissions[19]) {
      ?>
        <li>
          <a href="<?= site_url('Admin-News'); ?>"><i class="fa fa-newspaper-o"></i> News Management</a>
        </li>
      <?php
      }
      ?>

      <?php
      if (isset($permissions[22]) && $permissions[22]) {
      ?>
        <li>
          <a href="<?= site_url('Professional-Request'); ?>"><i class="fa fa-address-book"></i> Professional Requests</a>
        </li>
      <?php
      }
      ?>

      <?php
      if (isset($permissions[25]) && $permissions[25]) {
      ?>
        <li>
          <a href="<?= site_url('Admin-Chat'); ?>"><i class="fa fa-commenting-o"></i> Contact Users</a>
        </li>
      <?php
      }
      ?>
    </ul>
  </div>
</div>