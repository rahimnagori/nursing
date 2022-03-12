<?php include_once('include/header.php'); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Business
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Business Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?=$this->session->flashdata('responseMessage');?>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Business Details</h3>
            </div>
            <form class="form-horizontal" action="<?=site_url();?>Admin_Business/update" method="post">
              <div class="changeUsenrameMessages"></div>
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Business Name</label>
                  <div class="col-sm-10">
                   <input type="text" class="form-control" name="business_name" placeholder="Business Name" value="<?=(!empty($businessDetails)) ? $businessDetails['business_name'] : '';?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Business Phone</label>
                  <div class="col-sm-10">
                   <input type="number" class="form-control" name="business_phone" placeholder="Business Name" value="<?=(!empty($businessDetails)) ? $businessDetails['business_phone'] : '';?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Business Primary Email</label>
                  <div class="col-sm-10">
                   <input type="email" class="form-control" name="business_email" placeholder="Business Primary Email" value="<?=(!empty($businessDetails)) ? $businessDetails['business_email'] : '';?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Business Secondary Email</label>
                  <div class="col-sm-10">
                   <input type="email" class="form-control" name="business_email_1" placeholder="Business Secondary Email" value="<?=(!empty($businessDetails)) ? $businessDetails['business_email_1'] : '';?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Business Address</label>
                  <div class="col-sm-10">
                   <input type="text" class="form-control" name="business_address" placeholder="Business Address" value="<?=(!empty($businessDetails)) ? $businessDetails['business_address'] : '';?>">
                  </div>
                </div>
              </div>
              <div class="box-footer">
               <input type="hidden" name="id" value="<?=(!empty($businessDetails)) ? $businessDetails['id'] : '';?>">
                <button type="submit" class="btn btn-info pull-right" data-loading-text="Loading..." id="changeUsernameBtn">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include_once('include/footer.php'); ?>