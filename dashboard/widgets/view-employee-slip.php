 <?php include '../core/init.php';?>
 <div class="container-fluid">
<div class="row">
 <div class="col-sm-12">
 <div class="card">
  <div class="card-header">
    Select Employee to generate Slip
  </div>
  <div class="card-body">
   <table class="table table-bordered" id="all-payments-table">
    <?php
    $sql="SELECT * FROM  tb_employee ORDER BY id DESC";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
      <th style="display:none;">id</th>
      <th>#</th>
      <th>Employee</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Job Title</th>
      <th>Department </th>
      <th>Action</th>
    </thead>
    <tbody>
     <?php 
      $no=1;
      while($row=mysqli_fetch_array($result))
      { 
        $id=$row['id'];
        $name=$row['full_name'];
        $phone=$row['phone_number'];
        $email=$row['email'];
        $job=$row['job_title'];
        $department=$row['department'];

        ?>
         <tr>
           <td style="display:none;"><?php echo $id?></td>
           <td><?php echo $no;?></td>
           <td><?php echo $name;?></td>
           <td><?php echo $phone;?></td>
           <td><?php echo $email;?></td>
           <td><?php echo $job;?></td>
           <td><?php echo $department;?></td>
           <td><button class="btn btn-outline-info btn-sm" id="button-view-slips" data-toggle="modal" data-target="#slipsModal" onclick='view_slips($(this))'><i class="fa fa-eye"></i></button></td>
         </tr>
        <?php
        $no++;
      }
      ?>
    </tbody>
      
    </table>

  </div>
</div>
</div>
</div>

<!--View Modal -->
<div class="modal fade" id="slipsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
        <b id="quo_code"></b> <b>Payment Slip</b>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="quotation-content">
       
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

     $(function(){

       $('#button-view-slips').submit(function(e){
        view_slips();
      });
     });

   function view_slips(btn){
       var tr = $(btn).parent().parent();
      var cid = $(tr).children('td:eq(0)').html();
      var name = $(tr).children('td:eq(2)').html();
  
      document.getElementById("quo_code").innerHTML = name;
      var json = JSON.stringify([cid,name]);
      
         $.post('widgets/populate-slip-modal.php',
                {
                   data:json
                },function(data,status){
                    document.getElementById("quotation-content").innerHTML=data;
                  });
     }

    function generate_pay_slip(empid){
    var json = JSON.stringify([empid]);
     $('#generate-pay-slip').html('<i class="fa fa-pulse fa-refresh"></i> Sending Email...');
    $.post('functions/pay_slip_pdf_generator.php',
                {
                   data:json
                },function(data,status){
                     if (data.replace(/\s/g, "") === 'success') {
               $('#generate-pay-slip').html('<i class="fa fa-file-text-o" aria-hidden="true"></i> Generate');
                  Toastify({ 
                    text: "Success!\n Payslip sent to email successifully.",
                    duration: 2000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #00b09b, #96c93d)",
                     }
                }).showToast();

                   } else {
                     Toastify({ 
                    text: "Error!\n Unable to send email. Check your internet connection\n Note Payslip has been generated and saved",
                    duration: 6000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #E64134, #96c93d)",
                     }
                }).showToast();
                   }
                  });
   }   
</script>
