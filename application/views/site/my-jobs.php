<div class="dasboadd">
   <div class="container">
      <div class="row">
         <div class="col-sm-3">
            <?php include 'include/sidebar.php'; ?>
         </div>
         <div class="col-sm-9">
            <div class="right_box">
               <h4 class="hedding_right">Applied Jobs</h4>
               <div class="card_bodym">
                  <div class="table-responsive">
                     <table id="extent_tbl1" class="table display">
                        <thead>
                           <tr>
                              <th>S.No.</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Salary</th>
                              <th>Qualification</th>
                              <th>Payment Type</th>
                              <th>Last Date</th>
                        </thead>
                        <tbody>
                           <?php
                              foreach($appliedJobs as $serialNumber => $appliedJob) {
                           ?>

                              <tr>
                                 <td><?=$serialNumber + 1;?></td>
                                 <td><?=$appliedJob['title'];?></td>
                                 <td><?=$appliedJob['description'];?></td>
                                 <td><?=$this->config->item('CURRENCY');?><?=$appliedJob['salary'];?></td>
                                 <td><?=$appliedJob['qualification'];?></td>
                                 <td><?=$paymentTypes[$appliedJob['payment_type']];?></td>
                                 <td><?=date("d M, Y", strtotime($appliedJob['last_date']));?></td>
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