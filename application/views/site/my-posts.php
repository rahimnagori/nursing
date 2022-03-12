<div class="dasboadd">
  <div class="container">
     <div class="row">
        <div class="col-sm-3">
          <?php include 'include/sidebar.php'; ?>
        </div>
        <div class="col-sm-9">
           <div class="right_box">
              <h4 class="hedding_right">Table</h4>
              <div class="card_bodym">
                 <div class="table-responsive">
                    <table id="extent_tbl1" class="table display">
                       <thead>
                          <tr>
                             <th>S.No.</th>
                             <th>demo</th>
                             <th>Date</th>
                             <th>Price</th>
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
     </div>
  </div>
</div>