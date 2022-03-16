<?php include 'include/header.php'; ?>

<div class="conten_web">
  <h4 class="heading">Profile <span><a href="javascript:void(0);" class="btn btn_theme2" data-toggle="modal" data-target="#Add_polls">modal</a></span></h4> 

  <div class="ddd">
    <div class="row">
      <div class="col-sm-12">
        <?=$this->session->flashdata('responseMessage');?>
        <div class="row">
          <div class="col-md-6">
          <div class="white_box">
    <div class="card_bodym">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Update Profile</h3>
              </div>
              <form class="form-horizontal" id="techform" action="<?=site_url('Update-Admin');?>" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                     <input type="email" class="form-control" name="email" id="email" placeholder="email" value="<?=$adminData['email'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="Username" class="col-sm-2 control-label"> First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?=$adminData['first_name'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="Username" class="col-sm-2 control-label"> Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?=$adminData['last_name'];?>">
                    </div>
                  </div>
                </div>
                <div class="box-footer text-right">
                 <input type="hidden" name="id" id="id" value="<?=$adminData['id'];?>">
                  <button type="submit" class="btn btn-info " data-loading-text="Loading..." id="changeUsernameBtn">Update</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
            </div>
            </div>
          </div>
           <div class="col-md-6">
           <div class="white_box">
    <div class="card_bodym">
      
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Change Password</h3>
              </div>
               <form class="form-horizontal" method="post" id="passoword_form" action="<?=site_url('Update-Admin-Password');?>">
                <input type="hidden" name="id" id="id" value="<?=$adminData['id'];?>">
                <div class="box-body">
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Current Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="npassword" class="col-sm-2 control-label">New password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="renewPassword" name="renewPassword" placeholder="Confirm New Password">
                      <span class="text-danger"></span>
                    </div>
                  </div>
                </div>
                <div class="box-footer text-right">
                  <button type="submit" class="btn btn-info">Save &amp; Changes</button>
                </div>
              </form>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal us -->


<!-- Modal -->
<div class="modal fade " id="Add_polls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

     <div class="modal-header">

      <h4 class="modal-title">Add Poll</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="la la-times-circle"></i></span></button>

        

      </div>

      <div class="modal-body">

        <div class="optio_raddipo">
            <div class="form-group">
              <label class="radio"> First Choose 
                <input type="radio" checked="checked" name="is_company">
                <span class="checkround"></span>
              </label>
              <input type="text" name="" class="form-control" value="Option 1">
            </div>
            <div class="form-group">
              <label class="radio"> Second Choose 
                <input type="radio"  name="is_company">
                <span class="checkround"></span>
              </label>
              <input type="text" name="" class="form-control" value="Option 1">
            </div>
            <div class="form-group">
              <label class="radio"> Third Choose
                <input type="radio"  name="is_company">
                <span class="checkround"></span>
              </label>
              <input type="text" name="" class="form-control" value="Option 1">
            </div>
            <div class="form-group">
                <label class="check ">Scheduling Date
    <input type="checkbox" name="Scheduling_dtae" id="MyCheckBox">
  <span class="checkmark"></span>
</label>
            </div>
           
            

            <div class="form-group">
              <a href="#" class="btn btn_theme2 btn-lg">Submit</a>
            </div>
        </div>

      </div>

      

    </div>

  </div>

</div>
<!-- Modal close-->
<!-- modal us -->
<?php include 'include/footer.php'; ?>