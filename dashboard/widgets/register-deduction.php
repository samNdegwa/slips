<?php include '../core/init.php';?>
<div class="container-fluid">
<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-money"></i> Manage Employee Deductions</h4>

                </div>
                <div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-plus"></i> Select Employee to Add deduction for</h4>

                </div>
                <div class="card-body">
                <form method="POST" id="form-save-deduction">
                <div class="card-body">
                   <div class="form-group">
                   <label for="exampleInputEmail1">Select Employee</label>
                   <select class="form-control select_control" id="employee_selected" required="">
                   <option value="" required="">----Select----</option>
                    <?php
                     $sq="SELECT * FROM tb_employee ORDER BY id DESC";
                     $res=mysqli_query($con,$sq) or die(mysql_error());
                     while($row=mysqli_fetch_array($res))
                       {  
                           echo "<option value='".$row['id']."'>".$row['full_name']."</option>";
                        }
                        ?>
                      </select>
                     <small id="emailHelp" class="form-text text-muted"></small>
                     </div>

                    <div class="form-group">
                   <label for="exampleInputEmail1">Select Deduction Type</label>
                   <select class="form-control" id="deduction_type" required="">
                   <option value="" required="">----Select----</option>
                    <?php
                     $sqll="SELECT * FROM deduction_type";
                     $res=mysqli_query($con,$sqll) or die(mysql_error());
                     while($row=mysqli_fetch_array($res))
                       {  
                           echo "<option value='".$row['id']."'>".$row['deduction_name']."</option>";
                        }
                        ?>
                      </select>
                     <small id="emailHelp" class="form-text text-muted"></small>
                     </div>
                      <div class="form-group">
                     <label>Amount (Ksh)</label>
                      <input type="number" class="form-control" id="amount_deduct" placeholder="e.g 30000" required="">
                      </div>
                 
                    </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="float:right;" id="btn-save-earnings"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
                </div>
              </form>
                  
                </div>

            </div>

        </div>
        <div class="col-sm-6">
        <div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
   <div id="employee_aernings">
     <h6>Select Employee to see his/her deductions</h6>
   </div>

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
      $('#form-save-deduction').submit(function(e){
        e.preventDefault();
        sendSaveDeduction();
      });

      $(".select_control").change(function() {
        var selectedValue = this.value;
        var json = JSON.stringify([selectedValue]);
        $.post('functions/populate-employee-deductions-table.php',
          {
            data:json
          },function(data,status){
             //$('#customer_locations').val(data);
             document.getElementById("employee_aernings").innerHTML=data;
          }
          );

       
     }); 
     });

 function sendSaveDeduction() {
          var empid = $('#employee_selected').val();
          var earnType = $('#deduction_type').val();
          var amount = $('#amount_deduct').val();

          var json = JSON.stringify([empid,earnType,amount]);

          $('#form-send-single-message button').html('<i class="fa fa-pulse fa-refresh"></i> Loading...');
          $.post('functions/save-employee-deductions.php',
          {
            data:json
          },function(data,status){
             if (data.replace(/\s/g, "") === 'exist') {
              Toastify({ 
                    text: "Error!\n Deduction has already been added for this employee.",
                    duration: 6000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #E64134, #96c93d)",
                     }
                }).showToast();
             } else {
             if (data.replace(/\s/g, "") === 'success') {
                  Toastify({ 
                    text: "Success!\n Deduction saved successifully as an Employee",
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


