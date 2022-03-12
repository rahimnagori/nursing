<?php include 'include/header.php'; ?>
<div class="conten_web">
  <h4 class="heading">Dasboard</h4>
  <div class="white_box">
  	 <div class="card_bodym">
               <div class="table-responsive">
                  <table id="extent_tbl1" class="table display">
                     <thead>
                        <tr>
                           <th>S.No.</th>
                           <th>demo</th>
                           <th>Date</th>
                           <th>Price</th>
                           <th>Action</th>
                     </thead>
                     <tbody>
                        <?php
                          for($i = 0; $i <= 20; $i++){
                        ?>

                        <tr>
                           <td>1</td>
                           <td>demo</td>
                           <td>20/01/2020</td>
                           <td>&#8377; 150</td>
                           <td>

                           	<a href="#" class="btn btn-info btn-sm">Edit</a>
                           	<a href="#" class="btn btn-danger btn-sm">Delete</a>
                           </td>
                        </tr>
                        <?php
                             }
                           ?>
                     </tbody>
                  </table>
               </div>
            </div>
  </div>
</div>
<?php include 'include/footer.php'; ?>