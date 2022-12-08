<?php include '../core/init.php';?>
<div class="container-fluid">
<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-money"></i> Manage Deductions Types</h4>

                </div>
                <div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-th"></i> Availavble Deductios Types</h4>

                </div>
                <div class="card-body">
                <table class="table table-bordered">
    <?php
    $sql="SELECT * FROM deduction_type";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
      <th style="display:none;">id</th>
      <th>#</th>
      <th>Deduction Type</th>
      <th>Action</th>
    </thead>
    <tbody>
     <?php 
      $no=1;
      while($row=mysqli_fetch_array($result))
      { 
        $type=$row['deduction_name'];
        
        ?>
         <tr>
           <td><?php echo $no;?></td>
           <td><?php echo $type;?></td>
           <td><button class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
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
        <div class="col-sm-6">
        <div class="card">
  <div class="card-header">
     <h6>Add A new Deduction Type</h6>
  </div>
  <div class="card-body">
    <form id="deduct-data-form">
        <div class="form-group">
        <label>Enter Deduction Type</label>
        <input type="text" class="form-control" id="deduct_type" placeholder="e.g HELB Loan" required="">
        </div>

         <div class="card-footer">
         NOTE:<br> PAYE, NHIF, NSSF, Urigiti Welfare and Pension Scheme are autogerated from earning added.<br>
                  <button type="submit" class="btn btn-primary" style="float:right;" id="btn-save-deduct-type"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
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
<script>
 $(document).ready(function(){
      $('#deduct-data-form').submit(function(e){
        e.preventDefault();
        saveDeductions();
      });

     });

 function saveDeductions() {
          var deductType = $('#deduct_type').val();
          var json = JSON.stringify([deductType]);

          $('#deduct-data-form button').html('<i class="fa fa-pulse fa-refresh"></i> Loading...');
          $.post('functions/save-deductions-type.php',
          {
            data:json
          },function(data,status){
             if (data.replace(/\s/g, "") === 'exist') {
              $('#deduct-data-form button').html('<i class="fa fa-paper-plane" aria-hidden="true"></i> Save');
              Toastify({ 
                    text: "Error!\n "+deductType+" has already been added.",
                    duration: 6000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #E64134, #96c93d)",
                     }
                }).showToast();
             } else {
             if (data.replace(/\s/g, "") === 'success') {
               $('#all-main-contents').load('widgets/deduction-types.php');
                  Toastify({ 
                    text: "Success!\n "+deductType+" saved successifully",
                    duration: 2000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #00b09b, #96c93d)",
                     }
                }).showToast();

                   } else {
                     Toastify({ 
                    text: "Error!\n Unable to save data. Check your internet connection",
                    duration: 6000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #E64134, #96c93d)",
                     }
                }).showToast();
                   }
                 }
                
          }
          );

        }
</script>
